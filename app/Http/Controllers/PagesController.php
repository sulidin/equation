<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{


    public function shop()
    {
         return view('pages.shop');
    }

    public function contact()
    {
         return view('pages.contact');
    }

    public function cart()
    {
         return view('pages.cart');
    }





}
