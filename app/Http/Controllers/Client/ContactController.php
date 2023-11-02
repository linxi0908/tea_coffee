<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Information;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::get();
        $informations = Information::get();
        $productCategories= ProductCategory::where('status', 1)->get();
        $cart = session()->get('cart')?? [];
        return view ('client.pages.contact.contact', [
            'contacts'=> $contacts,
            'productCategories' => $productCategories,
            'informations' => $informations,
            'cart' => $cart
            ]);
    }
}
