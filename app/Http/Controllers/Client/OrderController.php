<?php

namespace App\Http\Controllers\Client;

use App\Events\PlaceOrderSuccess;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Contact;
use App\Models\Information;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPaymentMethod;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function placeOrder(OrderRequest $request){
        try{
            $validatedData = $request->validated();


            DB::beginTransaction();

            $cart = session()->get('cart', []);

            if(empty($cart)){
                $message = 'Vui lòng chọn sản phẩm.';
                return redirect()->back()->with('message', $message);
            }

            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->district = $validatedData['district'];
            $order->address = $validatedData['address'];
            $order->note = $validatedData['note'];
            $order->status = Order::STATUS_PENDING;
            $order->save();

            $cart = session()->get('cart', []);
            $total = 0;
            foreach($cart as $productId => $item){
                $orderItems = new OrderItem;
                $orderItems->order_id = $order->id;
                $orderItems->product_id = $productId;
                $orderItems->product_name = $item['name'];
                $orderItems->product_price = $item['price'];
                $orderItems->qty = $item['qty'];
                $orderItems->save();
                $total += $item['price'] * $item['qty'];
            }

            $order->subtotal = $total;
            $order->total = $total;
            $order->save();



            $orderPaymentMethod = OrderPaymentMethod::create([
                'order_id' => $order->id,
                'payment_provider' => $request->payment_provider,
                'status' => OrderPaymentMethod::STATUS_PENDING,
                'total' => $order->total,
            ]);

            $user = User::find(Auth::user()->id);
            $user->phone = $request->phone;
            $user->save();

            //Reset cart
            session()->put('cart', []);
            DB::commit();

            if($request->payment_provider === 'vnpay'){
                date_default_timezone_set('Asia/Ho_Chi_Minh');

                $vnp_TxnRef = $order->id; //Mã giao dịch thanh toán tham chiếu của merchant
                $vnp_Amount = $order->total; // Số tiền thanh toán
                $vnp_Locale = 'vn'; //Ngôn ngữ chuyển hướng thanh toán
                $vnp_BankCode = 'VNBANK'; //Mã phương thức thanh toán
                $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán

                $vnp_TmnCode = '7Z8LT5G1';
                $vnp_HashSecret = "LSNGIQUPOGFBKZTIXTLZXCFRFRATHJHP"; //Secret key
                $vnp_Returnurl = route('vnpay-callback');
                $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";

                $startTime = date("YmdHis");
                $expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));

                $inputData = array(
                    "vnp_Version" => "2.1.0",
                    "vnp_TmnCode" => $vnp_TmnCode,
                    "vnp_Amount" => $vnp_Amount * 100,
                    "vnp_Command" => "pay",
                    "vnp_CreateDate" => date('YmdHis'),
                    "vnp_CurrCode" => "VND",
                    "vnp_IpAddr" => $vnp_IpAddr,
                    "vnp_Locale" => $vnp_Locale,
                    "vnp_OrderInfo" => "Thanh toan GD: ". $vnp_TxnRef,
                    "vnp_OrderType" => "other",
                    "vnp_ReturnUrl" => $vnp_Returnurl,
                    "vnp_TxnRef" => $vnp_TxnRef,
                    "vnp_ExpireDate"=>$expire
                );

                if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                    $inputData['vnp_BankCode'] = $vnp_BankCode;
                }

                ksort($inputData);
                $query = "";
                $i = 0;
                $hashdata = "";
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                    } else {
                        $hashdata .= urlencode($key) . "=" . urlencode($value);
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }

                $vnp_Url = $vnp_Url . "?" . $query;
                if (isset($vnp_HashSecret)) {
                    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
                    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                }

                return Redirect::to($vnp_Url);
            }

            event(new PlaceOrderSuccess($order, $user, $cart));

            $message = 'Đặt hàng thành công!';
            return redirect()->route('profile.edit')->with('message', $message);;
        }catch(\Exception $exception){
            DB::rollBack();
            dd($exception->getMessage());
        }
    }

    public function vnpayCallback(Request $request)
    {
        $order = Order::find($request->vnp_TxnRef);
        $errorCode = $request->vnp_ResponseCode;
        $errorMessage = '';

        if ($$errorCode === '00') {
            $order->status = Order::STATUS_SUCCESS;
            $order->save();

            $user = User::find($order->user_id);

            $cart = [];
            foreach($order->order_items as $item){
                $product = Product::find($item->product_id);
                $imagesLink = is_null($product->image)
                || !file_exists('images/' . $product->image)
                ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg'
                : asset('images/' . $product->image);
                $cart[$item->product_id] = [
                    'name' => $item->product_name,
                    'price' => $item->product_price,
                    'image' => $imagesLink,
                    'qty' => $item->qty
                ];
            }

            $orderPaymentMethods = $order->order_payment_methods[0];
            $orderPaymentMethods->status = OrderPaymentMethod::STATUS_SUCCESS;
            $orderPaymentMethods->note = $request->vnp_OrderInfo;
            $orderPaymentMethods->total = ($request->vnp_Amount)/100;
            $orderPaymentMethods->save();

            event(new PlaceOrderSuccess($order, $user, $cart));
            $message = 'Thanh toán thành công!';
        }elseif ($errorCode === '07') {

            $errorMessage = 'Giao dịch bị nghi ngờ (liên quan tới lừa đảo, giao dịch bất thường)';
        } elseif ($errorCode === '09') {

            $errorMessage = 'Thẻ/Tài khoản của khách hàng chưa đăng ký dịch vụ InternetBanking tại ngân hàng';
        } elseif ($errorCode === '10') {

            $errorMessage = 'Khách hàng xác thực thông tin thẻ/tài khoản không đúng quá 3 lần';
        } elseif ($errorCode === '11') {

            $errorMessage = 'Đã hết hạn chờ thanh toán. Xin quý khách vui lòng thực hiện lại giao dịch';
        } elseif ($errorCode === '12') {

            $errorMessage = 'Thẻ/Tài khoản của khách hàng bị khóa';
        } elseif ($errorCode === '13') {

            $errorMessage = 'Khách hàng nhập sai mật khẩu xác thực giao dịch (OTP)';
        } elseif ($errorCode === '24') {

            $errorMessage = 'Khách hàng hủy giao dịch';
        } elseif ($errorCode === '51') {

            $errorMessage = 'Tài khoản của khách hàng không đủ số dư để thực hiện giao dịch';
        } elseif ($errorCode === '65') {

            $errorMessage = 'Tài khoản của khách hàng đã vượt quá hạn mức giao dịch trong ngày';
        } elseif ($errorCode === '75') {

            $errorMessage = 'Ngân hàng thanh toán đang bảo trì';
        } elseif ($errorCode === '79') {

            $errorMessage = 'Khách hàng nhập sai mật khẩu thanh toán quá số lần quy định';
        } elseif ($errorCode === '99') {

            $errorMessage = 'Có lỗi xảy ra';
        } else {

            $errorMessage = 'Mã lỗi không xác định';
        }

        if ($errorCode !== '00') {

            $order->status = Order::STATUS_FAILED;
            $order->save();

            $orderPaymentMethods = $order->order_payment_methods[0];
            $orderPaymentMethods->status = 'failed';
            $orderPaymentMethods->note = 'Giao dịch không thành công';
            $orderPaymentMethods->save();

            $message = 'Thanh toán không thành công! ' . $errorMessage;
        }

        return redirect()->route('profile.edit')->with('message', $message);
    }

    public function orderDetail($orderId){
        $order = Order::findOrFail($orderId);
        $informations = Information::get();
        $orderItems = $order->order_items;
        $productCategories = ProductCategory::where('status', 1)->get();
        $contacts = Contact::get();
        return view('client.pages.order_detail.order_detail',[
            'orderItems' => $orderItems,
            'order' => $order,
            'productCategories' => $productCategories,
            'contacts' => $contacts,
            'informations' => $informations
        ]);
    }

    public function updateOrderStatus($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->status = Order::STATUS_SUCCESS;
        $order->save();

        $orderPaymentMethod = OrderPaymentMethod::findOrFail($orderId);
        $orderPaymentMethod->status = OrderPaymentMethod::STATUS_SUCCESS;
        $orderPaymentMethod->save();

        $message = 'Cập nhật trạng thái đơn hàng thành công';

        return redirect()->back()->with('message', $message);
    }
}


