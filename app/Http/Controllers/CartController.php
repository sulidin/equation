<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coffee;
use App\Models\PurchasedItem;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $coffee = Coffee::findOrFail($id);

        // Get the current cart contents from the session
        $cart = session()->get('cart', []);

        // If the item is already in the cart, increment the quantity
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Otherwise, add the item to the cart with a quantity of 1
            $cart[$id] = [
                'name' => $coffee->name,
                'quantity' => 1,
                'price' => $coffee->selling_price,
                'pic' =>$coffee->pic
            ];
        }

        // Update the cart contents in the session
        session()->put('cart', $cart);

        // Redirect the user back to the coffee details page
        return redirect()->back()->with('success', 'Item added to cart successfully!');
    }


    public function viewCart()
    {
        // Get the current cart contents from the session
        $cart = session()->get('cart', []);

        // Calculate the total price and quantity of the items in the cart
        $totalPrice = 0;
        $totalQuantity = 0;

        foreach($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
            $totalQuantity += $item['quantity'];
        }

        return view('pages.cart', compact('cart', 'totalPrice', 'totalQuantity'));
    }

    public function checkout()
        {
            // Get the current cart contents from the session
            $cart = session()->get('cart', []);

            // Create an array to hold the purchased items
            $purchasedItems = [];

            foreach($cart as $id => $item) {
                 // Update the stock of the corresponding coffee item
                $coffee = Coffee::findOrFail($id);
                $coffee->stock -= $item['quantity'];
                $coffee->save();

                // Create a new purchased item record for each item in the cart
                $purchasedItem = new PurchasedItem([
                    'coffee_id' => $id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'purchase_date' => now(),
                    // Add the user id to the purchased item
                    'user_id' => auth()->user()->id

                ]);

                // Add the purchased item to the array
                $purchasedItems[] = $purchasedItem;
            }

            // Save the purchased items to the database
            auth()->user()->purchasedItems()->saveMany($purchasedItems);

            // Clear the cart
            session()->forget('cart');

            // Redirect the user back to the cart page with a success message
            return redirect()->route('cart.view')->with('success', 'Items purchased successfully!');
        }



    public function removeFromCart(Request $request, $id)
    {
        // Get the current cart contents from the session
        $cart = session()->get('cart', []);

        // Remove the item from the cart
        unset($cart[$id]);

        // Update the cart contents in the session
        session()->put('cart', $cart);

        // Redirect the user back to the cart page with a success message
        return redirect()->route('cart.view')->with('success', 'Item removed from cart successfully!');
    }

    public function changeQuantity(Request $request, $id)
    {
        // Get the current cart contents from the session
        $cart = session()->get('cart', []);

        // Update the quantity of the item in the cart
        $cart[$id]['quantity'] = $request->input('quantity');

        // Update the cart contents in the session
        session()->put('cart', $cart);

        // Redirect the user back to the cart page with a success message
        return redirect()->route('cart.view')->with('success', 'Cart updated successfully!');
    }
}