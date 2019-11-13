<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Brand;
use App\Category;
use App\Product;
use App\Unity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::all();
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product= new Product;

        $this->authorize('create', $product);

        $unities=Unity::all();
        $categories=Category::all();
        $brands=Brand::all();

        return view('admin.products.create', compact('product','unities', 'categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $this->authorize('create', new Product);

        //validar el formulario
        $data = $request->validate([
            'code' => 'required|unique:products',
            'name' => 'required',
            'price' => 'required',
            //'image' => 'required',
            'category'=>'required',
            'brand'=>'required',
            //'unity'=>'required',
        ],[
            'code.required'=>'El campo Código es obligatorio.',
            'name.required'=>'El campo Nombre es obligatorio.',
            'precio.required'=>'El campo Precio es obligatorio.',
            //'image.required'=>'El campo Imagen es obligatorio.',
            'category.required'=>'El campo Categoría es obligatorio.',
            'brand.required'=>'El campo Marca es obligatorio.',
            'unity.required'=>'El campo Unidad es obligatorio.',
        ]);

        //Crear al producto
        //if($request->hasFile('image')){
        //    $product->image=$request->file('image')->store('public/products');
        //}
        $product = new Product($data);
        //$product = Product::create($data);
        $product->code=$request->get('code');
        $product->name=$request->get('name');
        $product->price=$request->get('price');
        $product->description=$request->get('description');
        $product->category_id=$request->get('category');
        $product->brand_id=$request->get('brand');
        $product->unity_id=$request->get('unity');
        if($request->hasFile('image')){
            $product->image=$request->file('image')->store('public/products');
        }
        $product->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Creó un nuevo producto';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        //Regresamos al usuario
        return redirect()->route('admin.products.index')->withFlash('El producto ha sido creado');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $this->authorize('view', $product);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        //$data=Product::find($product);
        //return view('admin.products.edit', compact('data'));
        $unities=Unity::all();
        $categories=Category::all();
        $brands=Brand::all();
        return view('admin.products.edit', compact('product','unities', 'categories','brands'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Product $product)
    {
        //permiso
        $this->authorize('update', $product);

        //validar el formulario
        $this->validate($request,[
            'name' => 'required',
            'price' => 'required',
            'category'=>'required',
            'brand'=>'required',
        ],[
            'name.required'=>'El campo Nombre es obligatorio.',
            'precio.required'=>'El campo Precio es obligatorio.',
            'category.required'=>'El campo Categoría es obligatorio.',
            'brand.required'=>'El campo Marca es obligatorio.',
        ]);

        //modificar al producto
        if($request->hasFile('image')){
            $product->image=$request->file('image')->store('public/products');
        }
        $product->name=$request->get('name');
        $product->price=$request->get('price');
        $product->description=$request->get('description');
        $product->unity_id=$request->get('unity');
        $product->category_id=$request->get('category');
        $product->brand_id=$request->get('brand');
        //$product->update($request->validate($data));
        $product->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Editó un producto';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.products.index', $product)->withFlash('Producto actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Eliminó un producto';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.products.index')->withFlash('El producto ha sido eliminado');
    }
}
