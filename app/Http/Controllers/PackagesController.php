<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Event;
use App\Package;
use App\Package_Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages=Package::all();
        return view('admin.packages.index',compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $package= new Package;
        $this->authorize('create', $package);
        return view('admin.packages.create', compact('package'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Package);

        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image'=>'mimes:jpeg,bmp,png',
        ],[
            'name.required'=>'El campo Nombre es obligatorio.',
            'price.required'=>'El campo Precio es obligatorio.',
            'image.mimes'=>'El campo Imagen es obligatorio.',
        ]);
        $package = new Package($data);
        $package->name=$request->get('name');
        $package->price=$request->get('price');
        $package->description=$request->get('description');
        if(Input::hasFile('image')){
            $file=Input::file('image');
            $file->move(public_path().'/images/combos/',$file->getClientOriginalName());
            $package->image=$file->getClientOriginalName();
        }
        $package->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Creó un nuevo combo';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.packages.index')->withFlash('El combo ha sido creado');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        $this->authorize('view', $package);
        $packages = Package_Product::all();
        return view('admin.packages.show', compact('package','packages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        $this->authorize('update', $package);
        return view('admin.packages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        $this->authorize('update', $package);

        //validar el formulario
        $this->validate($request,[
            'image' => 'required',
            'name' => 'required',
            'description' => 'required',
        ],[
            'image.required'=>'El campo Imagen es obligatorio.',
            'name.required'=>'El campo Nombre es obligatorio.',
            'description.required'=>'El campo Descripción es obligatorio.',
        ]);

        if(Input::hasFile('image')){
            $file=Input::file('image');
            $file->move(public_path().'/images/combos/',$file->getClientOriginalName());
            $package->image=$file->getClientOriginalName();
        }
        $package->name=$request->get('name');
        $package->description=$request->get('description');
        $package->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Editó un combo';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.packages.index', $package)->withFlash('Combo actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $this->authorize('delete', $package);
        $package->delete();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Eliminó un combo';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.packages.index')->withFlash('El combo ha sido eliminado');
    }
}
