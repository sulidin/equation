<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Coffee;
use App\Models\Cart;
use Carbon\Carbon;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       //do join tables here
   
       $cartitems = CartItem::all();
       return view('cartitems.index')->with('cartitems',$cartitems);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $this->validate($request,[
            'quantity'=>'required',
            'purchased_price'=>'required',
            'coffee_id'=>'required|integer']);
         $cartitem = new CartItem();
         
         $cartitem->order_date = Carbon::parse($cartitem->created_at)->toDateString();
         
        $cartitem->quantity = $request->quantity;
        $cartitem->purchased_price = $request->purchased_price;
        //call parent
         //step 1: first find or create a cart for the user
        $cart = Cart::firstOrCreate(['user_id'=>auth()->user()->id]);
        $coffee=Coffee::findOrFail($request->coffee_id);
        $coffee->cartitems()->save($cartitem);
         
       return redirect()->route('cartitems.index');
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
}
