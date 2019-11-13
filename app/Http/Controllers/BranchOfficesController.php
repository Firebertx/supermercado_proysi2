<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\BranchOffice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchOfficesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branchOffices=BranchOffice::all();
        return view('admin.branchOffices.index',compact('branchOffices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branchOffice= new BranchOffice;
        $this->authorize('create', $branchOffice);
        return view('admin.branchOffices.create', compact('branchOffice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new BranchOffice);

        $data = $request->validate([
            'name' => 'required|unique:branch_offices',
            'location' => 'required',
            //'image' => 'required',
        ],[
            'name.required'=>'El campo Nombre es obligatorio.',
            'location.required'=>'El campo Dirección es obligatorio.',
            //'image.required'=>'El campo Imagen es obligatorio.',
        ]);

        $branchOffice = new BranchOffice($data);
        $branchOffice->name=$request->get('name');
        $branchOffice->address=$request->get('location');
        $branchOffice->latitude=$request->get('lat');
        $branchOffice->length=$request->get('lng');
        if($request->hasFile('image')){
            $branchOffice->image=$request->file('image')->store('public/branchOffices');
        }
        $branchOffice->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Creó una nueva sucursal';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.branchOffices.index')->withFlash('La sucursal ha sido creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(BranchOffice $branchOffice)
    {
        $this->authorize('view', $branchOffice);
        return view('admin.branchOffices.show', compact('branchOffice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(BranchOffice $branchOffice)
    {
        $this->authorize('update', $branchOffice);
        return view('admin.branchOffices.edit', compact('branchOffice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BranchOffice $branchOffice)
    {
        $this->authorize('update', $branchOffice);

        $this->validate($request,[
            'name' => 'required',
            'location' => 'required',
            //'image' => 'required',
        ],[
            'name.required'=>'El campo Nombre es obligatorio.',
            'location.required'=>'El campo Dirección es obligatorio.',
            //'image.required'=>'El campo Imagen es obligatorio.',
        ]);

        $branchOffice->name=$request->get('name');
        $branchOffice->address=$request->get('location');
        $branchOffice->latitude=$request->get('lat');
        $branchOffice->length=$request->get('lng');
        if($request->hasFile('image')){
            $branchOffice->image=$request->file('image')->store('public/branchOffices');
        }
        $branchOffice->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Editó una sucursal';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.branchOffices.index', $branchOffice)->withFlash('La sucursal ha sido actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BranchOffice $branchOffice)
    {
        $this->authorize('delete', $branchOffice);
        $branchOffice->delete();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Eliminó una sucursal';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.branchOffices.index')->withFlash('La sucursal ha sido eliminada');
    }
}
