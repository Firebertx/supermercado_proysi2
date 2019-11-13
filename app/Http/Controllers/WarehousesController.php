<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehousesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', new Warehouse());
        $warehouses = Warehouse::all();
        return view('admin.warehouses.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warehouse= new Warehouse;
        $this->authorize('create', $warehouse);
        return view('admin.warehouses.create', compact('warehouse'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Warehouse);

        $data = $request->validate([
            'name' => 'required|unique:warehouses',
            'location' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ],[
            'name.required'=>'El campo Nombre es obligatorio.',
            'location.required'=>'El campo Ubicación es obligatorio.',
            'lat.required'=>'El campo Latitud es obligatorio.',
            'lng.required'=>'El campo Longitud es obligatorio.',
        ]);

        $warehouse = new Warehouse($data);
        $warehouse->name=$request->get('name');
        $warehouse->location=$request->get('location');
        $warehouse->latitude=$request->get('lat');
        $warehouse->length=$request->get('lng');
        $warehouse->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Creó un nuevo almacén';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.warehouses.index')->withFlash('El almacén ha sido registrado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        $this->authorize('view', $warehouse);
        return view('admin.warehouses.show', compact('warehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        $this->authorize('update', $warehouse);
        return view('admin.warehouses.edit', compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        $this->authorize('update', $warehouse);

        $warehouse->name=$request->get('name');
        $warehouse->location=$request->get('location');
        $warehouse->latitude=$request->get('lat');
        $warehouse->length=$request->get('lng');
        $warehouse->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Editó un almacén';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.warehouses.index', $warehouse)->withFlash('El almacén ha sido actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        $this->authorize('delete', $warehouse);
        $warehouse->delete();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Eliminó un Almacén';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.warehouses.index')->withFlash('El almacén ha sido eliminado');
    }
}