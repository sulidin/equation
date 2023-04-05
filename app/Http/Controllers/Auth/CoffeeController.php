<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coffee;

class CoffeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coffees = Coffee::all();
        return view('coffees.index')->with('coffees', $coffees);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('coffees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        $fileName = time().$request->file('pic')->getClientOriginalName();
        $path = $request->file('pic')->storeAs('images',$fileName,'public');
        $requestData['pic'] = '/storage/'.$path;
        Coffee::create($requestData);
        return redirect('coffees')->with('flash_message','New Coffee Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $coffee = Coffee::find($id);
        return view('coffees.show')->with('coffees', $coffee);
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coffee = Coffee::find($id);
        return view('coffees.edit')->with('coffees',$coffee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $coffee = Coffee::find($id);
        $input = $request->all();
        $coffee->update($input);
        return redirect('coffees')->with('flash_message', 'Coffee Updated!');  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Coffee::destroy($id);
        return redirect('coffees.index')->with('flash_message', 'Coffee deleted!'); 
    }
}
