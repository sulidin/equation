<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CoffeeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;

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

Route::get('/', function () {
    return view('welcome');
});


//ADDED PAGES CONTROLLER

Route::resource('pages',PagesController::class);

Route::get('/cart', [PagesController::class, 'cart']);

Route::get('/contact', [PagesController::class, 'contact']);

Route::get('/item', [PagesController::class, 'item']);

Route::get('/dashboard', [PagesController::class, 'dashboard']);

Route::get('/shop', [PagesController::class, 'shop']);

Auth::routes(); 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('pages.index');
});


/*admin route*/

Route::group(['prefix' => 'admin', 'middleware' => ['auth','role']], function () {
    Route::get('/', [AdminController::class,'index'])->name('admin.home');
    Route::get('/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');
    // Add more routes for admin here...
    
    Route::resource('coffees',CoffeeController::class);
    Route::resource('users',UserController::class);
});


/*user route*/



Route::resource('coffees',CoffeeController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('coffees/{id}', [CoffeeController::class, 'show'])->name('coffees.show');
    Route::resource('carts',CartController::class);
    Route::resource('cartitems',CartItemController::class);
    // Route::get('cartitems',[CartItemController::class,'index'])->name('cartitems.index');
    // Route::get('cartitems/{id}',[CartItemController::class,'show'])->name('cartitems.show');
    // Route::post('cartitems/{id}',[CartItemController::class],'create')
    
});

// for carts route

