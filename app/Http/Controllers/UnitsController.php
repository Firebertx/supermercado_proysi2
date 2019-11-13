<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Unity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units=Unity::all();
        return view('admin.units.index',compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unity= new Unity;
        $this->authorize('create', $unity);
        return view('admin.units.create', compact('unity'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Unity);

        $data = $request->validate([
            'name' => 'required|unique:unities',
        ],[
            'name.required'=>'El campo Nombre es obligatorio.',
        ]);

        $unity = new Unity($data);
        $unity->name=$request->get('name');
        $unity->description=$request->get('description');
        $unity->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Creó una nueva unidad de medida';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.units.index')->withFlash('La unidad de medida ha sido creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Unity $unity)
    {
        $this->authorize('view', $unity);
        return view('admin.units.show', compact('unity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Unity $unity)
    {
        $this->authorize('update', $unity);
        return view('admin.units.edit', compact('unity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unity $unity)
    {
        $this->authorize('update', $unity);

        $this->validate($request,[
            'name' => 'required',
        ],[
            'name.required'=>'El campo Nombre es obligatorio.',
        ]);

        $unity->name=$request->get('name');
        $unity->description=$request->get('description');
        $unity->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Editó una unidad de medida';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.units.index')->withFlash('La unidad de medida ha sido actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unity $unity)
    {
        $this->authorize('delete', $unity);
        $unity->delete();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Eliminó una unidad de medida';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.units.index')->withFlash('La unidad de medida ha sido eliminada');
    }
}
