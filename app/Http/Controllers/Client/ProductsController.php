<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Information;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request, $slug = null)
    {
        $contacts = Contact::get();
        $informations = Information::get();
        $productCount = Product::count();
        $productCategories = ProductCategory::where('status', 1)->get();
        $cart = session()->get('cart') ?? [];

        $keyword = $request->input('keyword');
        $sortBy = $request->input('sortBy');


        $products = Product::where('status', 1)
        ->when(!empty($keyword), function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%')
                ->orWhereHas('product_categories', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
        })
        ->when(!empty($slug), function ($query) use ($slug) {
            $query->whereHas('product_categories', function ($q) use ($slug) {
                $q->where('slug', $slug);
            });
        })
        ->when(!empty($sortBy), function ($query) use ($sortBy) {
            $query->orderBy('price', $sortBy);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('client.pages.shop.shop', [
            'contacts' => $contacts,
            'productCategories' => $productCategories,
            'products' => $products,
            'cart' => $cart,
            'informations' => $informations,
            'productCount' => $productCount,
            'keyword' => $keyword,
            'sortBy' => $sortBy,
            'slug' => $slug,
        ]);
    }
}
