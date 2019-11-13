<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=Brand::all();
        return view('admin.brands.index',compact('brands', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand= new Brand;
        $this->authorize('create', $brand);
        return view('admin.brands.create', compact('brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Brand);


        $data = $request->validate([
            'name' => 'required|unique:brands',
        ],[
            'name.required'=>'El campo Nombre es obligatorio.',
        ]);

        $brand = new Brand($data);
        $brand->name=$request->get('name');
        if($request->hasFile('logo')){
            $brand->logo=$request->file('logo')->store('public/brands');
        }
        $brand->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Creó una nueva marca';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.brands.index')->withFlash('La marca ha sido creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        $this->authorize('view', $brand);
        return view('admin.brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        $this->authorize('update', $brand);
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $this->authorize('update', $brand);

        $this->validate($request,[
            'name' => 'required',
        ],[
            'name.required'=>'El campo Nombre es obligatorio.',
        ]);

        $brand->name=$request->get('name');
        $brand->description=$request->get('description');
        if($request->hasFile('logo')){
            $brand->logo=$request->file('logo')->store('public/brands');
        }
        $brand->save();

        $bitacora = new Bitacora();
        //$bitacora->user = [Auth::user()->name, Auth::user()->name];
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Editó una marca';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.brands.index')->withFlash('La marca ha sido actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $this->authorize('delete', $brand);
        $brand->delete();

        $bitacora = new Bitacora();
        //$bitacora->user = [Auth::user()->name, Auth::user()->name];
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Eliminó una marca';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.brands.index')->withFlash('La marca ha sido eliminada');
    }
}
