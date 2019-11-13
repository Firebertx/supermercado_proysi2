<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Combo;
use App\Combo_Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ComboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $combos=Combo::all();
        return view('admin.combos.index',compact('combos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $combo= new Combo();
        $this->authorize('create', $combo);
        return view('admin.combos.create', compact('combo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Combo());

        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image'=>'mimes:jpeg,bmp,png',
        ],[
            'name.required'=>'El campo Nombre es obligatorio.',
            'price.required'=>'El campo Precio es obligatorio.',
            'image.mimes'=>'El campo Imagen es obligatorio.',
        ]);
        $combos = new Combo($data);
        $combos->name=$request->get('name');
        $combos->price=$request->get('price');
        $combos->description=$request->get('description');
        if(Input::hasFile('image')){
            $file=Input::file('image');
            $file->move(public_path().'/images/combos/',$file->getClientOriginalName());
            $combos->image=$file->getClientOriginalName();
        }
        $combos->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Creó un nuevo combo';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.combos.index')->withFlash('El combo ha sido creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Combo $combo)
    {
        $this->authorize('view', $combo);
        $combos = Combo_Product::all();
        return view('admin.combos.show', compact('combo','combos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Combo $combo)
    {
        $this->authorize('update', $combo);
        return view('admin.combos.edit', compact('combo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Combo $combo)
    {
        $this->authorize('update', $combo);

        if(Input::hasFile('image')){
            $file=Input::file('image');
            $file->move(public_path().'/images/combos/',$file->getClientOriginalName());
            $combo->image=$file->getClientOriginalName();
        }
        $combo->name=$request->get('name');
        $combo->description=$request->get('description');
        $combo->price=$request->get('price');
        $combo->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Editó un combo';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.combos.index', $combo)->withFlash('Combo actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Combo $combo)
    {
        $this->authorize('delete', $combo);
        $combo->delete();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Eliminó un combo';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.combos.index')->withFlash('El combo ha sido eliminado');
    }
}
