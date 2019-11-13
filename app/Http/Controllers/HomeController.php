<?php

namespace App\Http\Controllers;

use App\Category;
use App\Combo;
use App\Event;
use App\Package;
use App\Product;
use App\Promotion;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products=Product::all();
        $combos=Combo::all();
        $promotions=Promotion::all();
        $categories=Category::all();
        return view('admin.dashboard', compact('products', 'combos', 'promotions', 'categories'));
    }
}
