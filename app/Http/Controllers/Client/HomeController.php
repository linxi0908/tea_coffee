<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Contact;
use App\Models\Information;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        //Get all records in table product_categorie
        $contacts = Contact::get();
        $informations = Information::get();
        $abouts = About::get();
        $productCategories= ProductCategory::where('status', 1)->get();
        $productCount= Product::count();
        $products = Product::where('status',1)->get();
        $featuredProducts = Product::where('featured',1)->orderBy('created_at','desc')->limit(8)->get();
        $cart = session()->get('cart')?? [];
        return view ('client.pages.home', [
            'abouts' => $abouts,
             'contacts'=> $contacts,
             'productCategories' => $productCategories,
             'products' => $products,
             'productCount' => $productCount,
             'featuredProducts' => $featuredProducts,
             'cart' => $cart,
             'informations' => $informations,
            ]);
    }
}


