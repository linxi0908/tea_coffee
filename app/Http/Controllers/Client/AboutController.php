<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Contact;
use App\Models\Information;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    public function view(){
        $contacts = Contact::get();
        $informations = Information::get();
        $abouts = About::get();
        $productCategories= ProductCategory::where('status', 1)->get();
        $cart = session()->get('cart')?? [];
        return view('client.pages.about.about',[
            'contacts' => $contacts,
            'abouts' => $abouts,
            'productCategories' => $productCategories,
            'cart' => $cart,
            'informations' => $informations
        ]);
    }
}
