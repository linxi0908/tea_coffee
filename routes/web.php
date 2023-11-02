<?php

use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\InformationController;
use App\Http\Controllers\Admin\InvoicesController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\AboutController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\GoogleController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Models\Contact;
use App\Models\Information;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'view'])->name('about');
Route::get('/products/{slug?}', [ProductsController::class, 'index'])->name('products');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
//Cart
Route::get('cart',[CartController::class,'index'])->name('cart.index');
Route::get('add_to_cart/{productId}',[CartController::class,'addToCart'])->name('add_to_cart');
Route::get('delete_item_in_cart', [CartController::class, 'emptyCart'])->name('delete_cart');
Route::get('delete_item_in_cart/{productId}', [CartController::class, 'deleteItem'])->name('delete_item_in_cart');
Route::get('update_item_in_cart/{productId}/{qty?}', [CartController::class, 'updateItem'])->name('update_item_in_cart');
Route::middleware('auth')->group(function(){
    Route::get('checkout', [CartController::class, 'checkout'])->name('checkout.index');
    Route::post('placeorder', [OrderController::class, 'placeOrder'])->name('place_order');
    Route::get('vnpay-callback', [OrderController::class, 'vnpayCallback'])->name('vnpay-callback');
    Route::get('order-detail/{orderId}', [OrderController::class, 'orderDetail'])->name('order_detail');
    Route::get('update-order-status/{orderId}', [OrderController::class, 'updateOrderStatus'])->name('update_order_status');
});
Route::get('google-redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('google-callback', [GoogleController::class, 'callback'])->name('google.callback');

Route::fallback(function () {
    $informations = Information::get();
    $contacts = Contact::get();
    return view('client.pages.404.404',[
        'informations' => $informations,
        'contacts' => $contacts
    ]);
});


Route::prefix('admin')->name('admin.')->middleware('auth.admin')->group(function () {
    //home
    Route::get('/', [AdminHomeController::class, 'index'])->name('index');

    //information
     Route::get('information/create', [InformationController::class, 'create'])->name('information.create');
     Route::post('information/store', [InformationController::class, 'store'])->name('information.store');
     Route::get('information/edit/{id}', [InformationController::class, 'edit'])->name('information.edit');
     Route::post('information/{id}', [InformationController::class, 'update'])->name('information.update');

     //contact
     Route::get('contact/create', [AdminContactController::class, 'create'])->name('contact.create');
     Route::post('contact/store', [AdminContactController::class, 'store'])->name('contact.store');
     Route::get('contact/edit/{id}', [AdminContactController::class, 'edit'])->name('contact.edit');
     Route::post('contact/{id}', [AdminContactController::class, 'update'])->name('contact.update');

     //about
     Route::get('about/create', [AdminAboutController::class, 'create'])->name('about.create');
     Route::post('about/store', [AdminAboutController::class, 'store'])->name('about.store');
     Route::get('about/edit/{id}', [AdminAboutController::class, 'edit'])->name('about.edit');
     Route::post('about/{id}', [AdminAboutController::class, 'update'])->name('about.update');

     //user
    Route::resource('user', UserController::class);

    //Product Category
    Route::get('product_category/{product_category}/restore',[ProductCategoryController::class,'restore'])->name('product_category.restore');
    Route::post('product_category/create/slug',[ProductController::class,'createSlug'])->name('product_category.create.slug');
    Route::resource('product_category', ProductCategoryController::class);

    //Product
    Route::get('product/{product}/restore',[ProductController::class,'restore'])->name('product.restore');
    Route::post('product/upload-image',[ProductController::class,'uploadImage'])->name('product.upload.image');
    Route::post('product/create/slug',[ProductController::class,'createSlug'])->name('product.create.slug');
    Route::resource('product', ProductController::class);



    //Invoices
    Route::get('invoices/checkout', [InvoicesController::class,'checkoutInvoice'])->name('invoice.checkout');
    Route::resource('invoices', InvoicesController::class);
    Route::get('invoices/print/{id}', [InvoicesController::class,'invoicePrint'])->name('invoice.print');
    Route::get('add_to_cart/{productId}',[InvoicesController::class,'addToCart'])->name('add_to_cart');
    Route::get('delete_item_in_cart/{productId}', [InvoicesController::class, 'deleteItem'])->name('delete_item_in_cart');
    Route::get('delete_item_in_cart', [InvoicesController::class, 'emptyCart'])->name('delete_cart');
    Route::post('placeorder', [InvoicesController::class, 'placeOrder'])->name('place_order');
    Route::get('vnpay-callback', [InvoicesController::class, 'vnpayCallback'])->name('vnpay-callback');
    Route::post('get_user_by_phone', [InvoicesController::class, 'getUserByPhone'])->name('get_user_by_phone');


});


