<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Information;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart($productId){
        $product = Product::findOrFail($productId);
        $cart = session()->get('cart') ?? [];
        $imagesLink = is_null($product->image) || !file_exists('images/products/' . $product->image)
        ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg'
        : asset('images/products/' . $product->image);
        $cart[$productId] = [
            'name' => $product->name,
            'price' => $product->price,
            'image' => $imagesLink,
            'qty' => ($cart[$productId]['qty'] ?? 0) + 1
        ];
        $cart = session()->put('cart', $cart);
        $cart = session()->get('cart');
        $total_price = $this->calculateTotalPrice($cart);
        $total_items = count($cart);

        return response()->json([
            'message' => 'Thêm vào giỏ hàng thành công',
            'total_items' => $total_items,
            'total_price' => $total_price
        ]);
    }

    public function calculateTotalPrice($cart): float{
        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['qty'];
        }
        return $total;
    }

    public function index(){
        $productCategories= ProductCategory::where('status', 1)->get();
        $contacts = Contact::get();
        $informations = Information::get();
        $cart = session()->get('cart')?? [];

        return view('client.pages.cart.cart',[
            'cart' => $cart,
            'productCategories' => $productCategories,
            'contacts' => $contacts,
            'informations' => $informations,
        ]);
    }

    public function deleteItem(Request $request, $productId){
        $cart = session()->get('cart', []);
        if(array_key_exists($productId, $cart)){
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }
        $total_price = $this->calculateTotalPrice($cart);
        $total_items = count($cart);
        return response()->json([
            'message' => 'Xóa sản phẩm thành công',
            'total_items' => $total_items,
            'total_price' => $total_price
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

    public function updateItem($productId, $qty){
        $cart = session()->get('cart', []);
        if(array_key_exists($productId, $cart)){
            $cart[$productId]['qty'] = $qty;
            if(!$qty){
                unset($cart[$productId]);
            }
            session()->put('cart', $cart);
        }
        $total_price = $this->calculateTotalPrice($cart);
        $total_items = count($cart);
        return response()->json([
            'message' => 'Cập nhật giỏ hàng thành công',
            'total_price' => $total_price,
            'total_items' => $total_items
        ]);
    }

    public function checkout(){
        $contacts = Contact::get();
        $informations = Information::get();
        $productCategories= ProductCategory::where('status', 1)->get();
        $cart = session()->get('cart')?? [];
        return view('client.pages.checkout.checkout', [
            'productCategories' => $productCategories,
            'contacts' => $contacts,
            'cart' => $cart,
            'informations' => $informations
        ]);
    }
}
