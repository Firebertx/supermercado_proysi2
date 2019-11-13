<?php

namespace App\Http\Controllers;

use App\Combo;
use App\Combo_Product;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ComboProductController extends Controller
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
        $combos_products = Combo_Product::all();
        $combos = Combo::all();
        $products = Product::all();
        return view('admin.combos_products.create', compact('combos_products','combos','products'));
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
            'combo' => 'required',
            'product' => 'required',
            'quantity' => 'required',
            'date' => 'required',
        ],[
            'combo.required'=>'El campo Combo es obligatorio.',
            'product.required'=>'El campo Producto es obligatorio.',
            'quantity.required'=>'El campo Cantidad es obligatorio.',
            'date.required'=>'El campo Fecha es obligatorio.',
        ]);

        $combo_product = new Combo_Product($data);
        $combo_product->package_id=$request->get('combo');
        $combo_product->product_id=$request->get('product');
        $combo_product->quantity=$request->get('quantity');
        $combo_product->sub_total=($request->get('quantity')*($combo_product->product->price));
        $combo_product->date=Carbon::parse($request->get('date'));
        $combo_product->save();

        return redirect()->route('admin.combos.show',$combo_product->package_id)->withFlash('Se ha añadido un nuevo producto al combo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        Combo_Product::destroy($id);
        return redirect()->route('admin.combos.index')->withFlash('El producto ha sido quitado');
    }
}
