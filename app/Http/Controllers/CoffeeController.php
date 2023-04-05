<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coffee;
use App\Models\Message;
use App\Models\PurchasedItem;

class CoffeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('role')->only(['dashboard', 'create', 'edit', 'update', 'destroy']);
    }

    public function show($id)
    {
        $coffee = Coffee::findOrFail($id);
        return view('coffees.show', compact('coffee'));
    }

    public function dashboard()
    {
        $coffees = Coffee::paginate(10);
        $messagess = Message::paginate(10);


        $yearlyEarnings = PurchasedItem::whereYear('purchase_date', now()->year)
            ->join('coffees', 'purchased_items.coffee_id', '=', 'coffees.id')
            ->sum(\DB::raw('(price - coffees.purchased_price) * quantity'));

        $monthlyEarnings = PurchasedItem::whereYear('purchase_date', now()->year)
            ->whereMonth('purchase_date', now()->month)
            ->join('coffees', 'purchased_items.coffee_id', '=', 'coffees.id')
            ->sum(\DB::raw('(price - coffees.purchased_price) * quantity'));

        $dailyEarnings = PurchasedItem::whereDate('purchase_date', now()->today())
            ->join('coffees', 'purchased_items.coffee_id', '=', 'coffees.id')
            ->sum(\DB::raw('(price - coffees.purchased_price) * quantity'));

        return view('coffees.dashboard', compact('coffees', 'yearlyEarnings', 'monthlyEarnings', 'dailyEarnings', 'messagess'));
    }



    public function shop()
    {
        $coffees = Coffee::paginate(12);
        return view('coffees.shop', compact('coffees'));
    }

    public function slider()
    {
        $coffees = Coffee::paginate(4);
        return view('pages.index', compact('coffees'));
    }

    public function create()
    {
        return view('coffees.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'stock' => 'required|integer',
            'selling_price' => 'required|numeric',
            'purchased_price' => 'required|numeric',
            'pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->pic->extension();
        $request->pic->move(public_path('images'), $imageName);

        Coffee::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'stock' => $validatedData['stock'],
            'selling_price' => $validatedData['selling_price'],
            'purchased_price' => $validatedData['purchased_price'],
            'pic' => $imageName
        ]);

        return redirect('/coffees')->with('success', 'Coffee Item has been added');
    }

    public function edit($id)
    {
        $coffee = Coffee::findOrFail($id);
        return view('coffees.edit', compact('coffee'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'stock' => 'required|integer',
            'selling_price' => 'required|numeric',
            'purchased_price' => 'required|numeric',
            'pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $coffee = Coffee::findOrFail($id);
        $coffee->name = $validatedData['name'];
        $coffee->description = $validatedData['description'];
        $coffee->stock = $validatedData['stock'];
        $coffee->selling_price = $validatedData['selling_price'];
        $coffee->purchased_price = $validatedData['purchased_price'];

        if ($request->hasFile('pic')) {
            $imageName = time().'.'.$request->pic->extension();
            $request->pic->move(public_path('images'), $imageName);
            $coffee->pic = $imageName;
        }

        $coffee->save();

        return redirect('/coffees')->with('success', 'Coffee Item has been updated');
    }

    public function destroy($id)
    {
        $coffee = Coffee::findOrFail($id);
        $coffee->delete();

        return redirect('/coffees')->with('success', 'Coffee Item has been deleted successfully');
    }

}