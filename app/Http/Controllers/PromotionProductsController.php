<?php

namespace App\Http\Controllers;

use App\Product;
use App\Promotion;
use App\PromotionProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PromotionProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promotions = Promotion::all();
        $products = Product::all();
        return view('admin.promotionProducts.create', compact('promotions','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'promotion' => 'required',
            'product' => 'required',
            'quantity' => 'required',
            'date' => 'required',
        ],[
            'promotion.required'=>'El campo Promoción es obligatorio.',
            'product.required'=>'El campo Producto es obligatorio.',
            'quantity.required'=>'El campo Cantidad es obligatorio.',
            'date.required'=>'El campo Fecha es obligatorio.',
        ]);

        $promotion_product = new PromotionProduct($data);
        $promotion_product->promotion_id=$request->get('promotion');
        $promotion_product->product_id=$request->get('product');
        $promotion_product->quantity=$request->get('quantity');
        $promotion_product->total=(($request->get('quantity')*($promotion_product->product->price))-($request->get('quantity')*($promotion_product->product->price)*($promotion_product->promotion->percentage)));
        $promotion_product->date=Carbon::parse($request->get('date'));
        $promotion_product->save();

        return redirect()->route('admin.promotions.show',$promotion_product->promotion_id)->withFlash('Se ha añadido un nuevo producto a la promoción');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PromotionProduct $promotion_product)
    {
        return view('admin.promotionProducts.show', compact('$promotion_product'));
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
        PromotionProduct::destroy($id);
        return redirect()->route('admin.promotions.index')->withFlash('El producto ha sido quitado');
    }
}
