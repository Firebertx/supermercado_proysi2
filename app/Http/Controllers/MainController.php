<?php

namespace App\Http\Controllers;

use App\Category;
use App\Combo;
use App\Combo_Product;
use App\Event;
use App\Package;
use App\Product;
use App\Promotion;
use App\PromotionProduct;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        $products=Product::all();
        $combos=Combo::all();
        $promotions=Promotion::all();
        $categories=Category::all();
        return view('main.home', compact('products', 'combos', 'promotions', 'categories'));
    }

    //PRODUCTOS
    public function category()
    {
        $products=Product::all();
        $packages=Package::all();
        $categories=Category::all();
        return view('main.category', compact('products', 'packages', 'categories'));
    }

    public function category1()
    {
        $products=Product::all();
        $categories=Category::all();
        return view('main.category1', compact('products', 'categories'));
    }
    public function category2()
    {
        $products=Product::all();
        $categories=Category::all();
        return view('main.category2', compact('products', 'categories'));
    }
    public function category3()
    {
        $products=Product::all();
        $categories=Category::all();
        return view('main.category3', compact('products', 'categories'));
    }
    public function category4()
    {
        $products=Product::all();
        $categories=Category::all();
        return view('main.category4', compact('products', 'categories'));
    }
    public function category5()
    {
        $products=Product::all();
        $categories=Category::all();
        return view('main.category5', compact('products', 'categories'));
    }
    public function category6()
    {
        $products=Product::all();
        $categories=Category::all();
        return view('main.category6', compact('products', 'categories'));
    }
    public function category7()
    {
        $products=Product::all();
        $categories=Category::all();
        return view('main.category7', compact('products', 'categories'));
    }
    public function category8()
    {
        $products=Product::all();
        $categories=Category::all();
        return view('main.category8', compact('products', 'categories'));
    }
    public function category9()
    {
        $products=Product::all();
        $categories=Category::all();
        return view('main.category9', compact('products', 'categories'));
    }
    public function category10()
    {
        $products=Product::all();
        $categories=Category::all();
        return view('main.category10', compact('products', 'categories'));
    }
    public function category11()
    {
        $products=Product::all();
        $categories=Category::all();
        return view('main.category11', compact('products', 'categories'));
    }
    public function category12()
    {
        $products=Product::all();
        $categories=Category::all();
        return view('main.category12', compact('products', 'categories'));
    }

    //COMBOS
    public function combo()
    {
        $combos=Combo::all();
        $combo_products=Combo_Product::all();
        return view('main.combo', compact('combos', 'combo_products'));
    }
    public function combo1()
    {
        $combos=Combo::all();
        $combo_products=Combo_Product::all();
        return view('main.combo1', compact('combos', 'combo_products'));
    }
    public function combo2()
    {
        $combos=Combo::all();
        $combo_products=Combo_Product::all();
        return view('main.combo2', compact('combos', 'combo_products'));
    }
    public function combo3()
    {
        $combos=Combo::all();
        $combo_products=Combo_Product::all();
        return view('main.combo3', compact('combos', 'combo_products'));
    }
    public function combo4()
    {
        $combos=Combo::all();
        $combo_products=Combo_Product::all();
        return view('main.combo4', compact('combos', 'combo_products'));
    }
    public function combo5()
    {
        $combos=Combo::all();
        $combo_products=Combo_Product::all();
        return view('main.combo5', compact('combos', 'combo_products'));
    }
    public function combo6()
    {
        $combos=Combo::all();
        $combo_products=Combo_Product::all();
        return view('main.combo6', compact('combos', 'combo_products'));
    }
    public function combo7()
    {
        $combos=Combo::all();
        $combo_products=Combo_Product::all();
        return view('main.combo7', compact('combos', 'combo_products'));
    }

    //PROMOCIONES
    public function promotion()
    {
        $promotions=Promotion::all();
        $promotion_products=PromotionProduct::all();
        return view('main.promotions', compact('promotions', 'promotion_products'));
    }

    public function promotion1()
    {
        $promotions=Promotion::all();
        $promotion_products=PromotionProduct::all();
        return view('main.promotion1', compact('promotions', 'promotion_products'));
    }
    public function promotion2()
    {
        $promotions=Promotion::all();
        $promotion_products=PromotionProduct::all();
        return view('main.promotion2', compact('promotions', 'promotion_products'));
    }
    public function promotion3()
    {
        $promotions=Promotion::all();
        $promotion_products=PromotionProduct::all();
        return view('main.promotion3', compact('promotions', 'promotion_products'));
    }
    public function promotion4()
    {
        $promotions=Promotion::all();
        $promotion_products=PromotionProduct::all();
        return view('main.promotion4', compact('promotions', 'promotion_products'));
    }
    public function promotion5()
    {
        $promotions=Promotion::all();
        $promotion_products=PromotionProduct::all();
        return view('main.promotion5', compact('promotions', 'promotion_products'));
    }
    public function promotion6()
    {
        $promotions=Promotion::all();
        $promotion_products=PromotionProduct::all();
        return view('main.promotion6', compact('promotions', 'promotion_products'));
    }
    public function promotion7()
    {
        $promotions=Promotion::all();
        $promotion_products=PromotionProduct::all();
        return view('main.promotion7', compact('promotions', 'promotion_products'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
