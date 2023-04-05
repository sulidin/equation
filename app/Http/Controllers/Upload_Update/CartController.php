<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Coffee;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = Cart::all();
        return view('carts.index')->with('carts',$cartItems);
   
    }

    /**
     * Show the form for creating a new resource.
     */
  

    /**
     * Store a newly created resource in storage.
     */
     
     public function store()
     {
         
     }
    
   
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    
public function create(Request $request)
{
    // Get the coffee ID and quantity from the form data
    $coffeeId = $request->input('coffee_id');
    $quantity = $request->input('quantity');

    // Get the coffee from the database
    $coffee = Coffee::findOrFail($coffeeId);

    // Add the item to the cart
    if($request->session()->has('cart')) {
        $cart = $request->session()->get('cart');
    } else {
        $cart = [];
    }

    if(isset($cart[$coffeeId])) {
        $cart[$coffeeId]['quantity'] += $quantity;
    } else {
        $cart[$coffeeId] = [
            'name' => $coffee->name,
            'price' => $coffee->selling_price,
            'quantity' => $quantity,
            'pic' => $coffee->pic
        ];
    }

    $request->session()->put('cart', $cart);

    // Redirect the user to the home page
    return redirect()->route('home');
}
}
