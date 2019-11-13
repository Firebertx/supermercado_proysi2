<?php

namespace App\Http\Controllers;

use App\Package;
use App\Package_Product;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PackageProductController extends Controller
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
        $packages_products = Package_Product::all();
        //$this->authorize('create', $package_product);
        $packages = Package::all();
        $products = Product::all();
        return view('admin.packageProduct.create', compact('packages_products','packages','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->authorize('create', new Pa);

        $data = $request->validate([
            'package' => 'required',
            'product' => 'required',
            'quantity' => 'required',
            'date' => 'required',
        ],[
            'package.required'=>'El campo Paquete es obligatorio.',
            'product.required'=>'El campo Producto es obligatorio.',
            'quantity.required'=>'El campo Cantidad es obligatorio.',
            'date.required'=>'El campo Fecha es obligatorio.',
        ]);

        $package_product = new Package_Product($data);
        $package_product->package_id=$request->get('package');
        $package_product->product_id=$request->get('product');
        $package_product->quantity=$request->get('quantity');
        $package_product->sub_total=($request->get('quantity')*($package_product->product->price));
        $package_product->date=Carbon::parse($request->get('date'));
        $package_product->save();

        return redirect()->route('admin.packages.show',$package_product->package_id)->withFlash('Se ha añadido un nuevo producto al paquete');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Package_Product $package_product)
    {
        //$this->authorize('view', $package);
        return view('admin.packages_products.show', compact('package_product'));
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
    public function destroy(Package_Product $data)
    {
        //$this->authorize('delete', $package_product);
        $data->delete();

        return redirect()->route('admin.packages.index')->withFlash('El producto ha sido quitado');
    }
}
