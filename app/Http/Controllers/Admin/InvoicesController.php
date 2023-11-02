<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\Models\Contact;
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

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::orderBy('created_at','desc')->paginate(10);

        return view('admin.pages.invoice.list',[
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contacts = Contact::get();
        $products = Product::where('status',1)->get();
        $productCategories= ProductCategory::where('status', 1)->get();
        $cart = session()->get('cart') ?? [];
        return view('admin.pages.invoice.create',[
            'contacts' => $contacts,
            'productCategories' => $productCategories,
            'products' => $products,
            'cart' => $cart
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $order_items = OrderItem::where('order_id',$id)
        ->get();
        $orderPaymentMethods = OrderPaymentMethod::get();

        return view('admin.pages.invoice.order_detail', [
            'order' => $order,
            'order_items' => $order_items,
            'orderPaymentMethods' => $orderPaymentMethods
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function invoicePrint($id)
    {
        $order = Order::findOrFail($id);
        $order_items = OrderItem::where('order_id',$id)->get();
        $contacts = Contact::get();
        return view('admin.pages.invoice.order_detail_print', [
            'order' => $order,
            'order_items' => $order_items,
            'contacts' => $contacts
        ]);
    }

    public function checkoutInvoice(){
        $contacts = Contact::get();
        $cart = session()->get('cart') ?? [];
        return view('admin.pages.invoice.place_order',[
            'contacts' => $contacts,
            'cart' => $cart
        ]);
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        $productCategories = ProductCategory::where('status', 1)->get();
        $cart = session()->get('cart') ?? [];
        $imagesLink = is_null($product->image) || !file_exists('images/products/' . $product->image)
        ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg'
        : asset('images/products/' . $product->image);
        $cart[$productId] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' => $imagesLink,
            'qty' => ($cart[$productId]['qty'] ?? 0) + 1,
            'deleteUrl' => route('admin.delete_item_in_cart', ['productId' => $productId]),
        ];
        $cart = session()->put('cart', $cart);
        session()->save();
        $cart = session()->get('cart');
        $total_price = $this->calculateTotalPrice($cart);

        return response()->json([
            'message' => 'Thêm vào giỏ hàng thành công',
            'total_price' => $total_price,
            'cart' => $cart
        ]);
    }

    public function calculateTotalPrice($cart): float{
        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['qty'];
        }
        return $total;
    }

    public function deleteItem(Request $request, $productId){
        $cart = session()->get('cart', []);
        if(array_key_exists($productId, $cart)){
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }
        $total_price = $this->calculateTotalPrice($cart);
        return response()->json([
            'message' => 'Xóa sản phẩm thành công',
            'total_price' => $total_price,
        ]);
    }

    public function emptyCart(){
        session()->put('cart', []);
        return response()->json([
            'message' => 'Xóa giỏ hàng thành công',
            'total_price' => 0,
            'total_items' => 0
        ]);
    }

    public function getUserByPhone(Request $request)
    {
        $phone = $request->input('phone');
        $user = User::where('phone', $phone)->first();

        if ($user) {
            return response()->json([
                'success' => true,
                'user' => $user
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function placeOrder(InvoiceRequest $request){
        try{
            $validatedData = $request->validated();

            DB::beginTransaction();

            $cart = session()->get('cart', []);

            if(empty($cart)){
                $message = 'Vui lòng chọn sản phẩm.';
                return redirect()->back()->with('message', $message);
            }

            $order = new Order;

            if ($request->has('phone')) {
                $user = User::where('phone', $request->phone)->first();
                if ($user) {
                    $order->user_id = $user->id;
                } else {
                    $order->user_id = Auth::user()->id;
                }
            }
            else {
                $order->user_id = Auth::user()->id;
            }
            $order->note = $validatedData['note'];
            $order->status = Order::STATUS_SUCCESS;
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
                'status' => OrderPaymentMethod::STATUS_SUCCESS,
                'total' => $order->total,
            ]);


            //Reset cart
            session()->put('cart', []);
            DB::commit();

            $message = 'Tạo đơn hàng thành công';
            return redirect()->route('admin.invoices.index')->with('message', $message);
        }catch(\Exception $exception){
            DB::rollBack();
            dd($exception->getMessage());
        }
    }
}
