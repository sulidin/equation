<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CoffeeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MessageController;




Route::get('/', function () {
    return view('pages.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//COFFEE CONTROLLER
Route::resource('coffees', 'App\Http\Controllers\CoffeeController');
Route::get('/shop', [CoffeeController::class, 'shop']);

//DASHBOARD
Route::get('/coffees', [CoffeeController::class, 'dashboard'])->name('coffees.dashboard');
Route::get('/home', [CoffeeController::class, 'slider'])->name('coffees.slider');
Route::get('/', [CoffeeController::class, 'slider'])->name('coffees.slider');

//CART ROUTING
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/change-quantity/{id}', [CartController::class, 'changeQuantity'])->name('cart.changeQuantity');

//PAGES CONTROLLER
Route::resource('pages',PagesController::class);
Route::get('/contact', [PagesController::class, 'contact']);


Route::post('messages', [MessageController::class, 'store'])->name('messages.store');
Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');





