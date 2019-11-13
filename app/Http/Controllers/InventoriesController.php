<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\BranchOffice;
use App\DetalleIngreso;
use App\DetalleInventario;
use App\Entry;
use App\Inventory;
use App\Product;
use App\Entry_Product;
use App\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', new Inventory());
        $inventories = Inventory::all();
        $warehouses=Warehouse::all();
        return view('admin.inventories.index', compact('inventories','warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $inventory= new Inventory;
        $this->authorize('create', $inventory);
        $warehouses=Warehouse::all();
        $branchOffices=BranchOffice::all();

        return view('admin.inventories.create', compact('inventory','warehouses','branchOffices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Inventory);

        $data = $request->validate([
            'name' => 'required|unique:inventories',
            'warehouse' => 'required',
        ],[
            'name.required'=>'El campo Nombre es obligatorio.',
            'warehouse.required'=>'El campo Almacén es obligatorio.',
        ]);

        $inventory = new Inventory($data);
        $inventory->name=$request->get('name');
        $inventory->description=$request->get('description');
        $inventory->warehouse_id=$request->get('warehouse');
        //$inventory->branchOffice_id=$request->get('branchOffice');
        $inventory->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Creó un nuevo inventario';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.inventories.index')->withFlash('El inventario ha sido creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        $this->authorize('view', $inventory);
        $detalleInventarios= DetalleInventario::all();
        return view('admin.inventories.show', compact('inventory','detalleInventarios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        $this->authorize('update', $inventory);
        $warehouses=Warehouse::all();
        return view('admin.inventories.edit', compact('inventory','warehouses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        $this->authorize('update', $inventory);

        $inventory->name=$request->get('name');
        $inventory->description=$request->get('description');
        $inventory->warehouse_id=$request->get('warehouse');
        $inventory->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Editó un inventario';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.inventories.index',$inventory)->withFlash('El inventario ha sido actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        $this->authorize('delete', $inventory);
        $inventory->delete();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Eliminó un inventario';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.inventories.index')->withFlash('El inventario ha sido eliminado');
    }
}
