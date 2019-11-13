<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Promotion;
use App\PromotionProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class PromotionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions=Promotion::all();
        return view('admin.promotions.index',compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promotion= new Promotion();
        $this->authorize('create', $promotion);
        return view('admin.promotions.create', compact('promotion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Promotion());

        $data = $request->validate([
            'name' => 'required',
            'image'=>'mimes:jpeg,bmp,png',
            'percentage'=>'required',
        ],[
            'name.required'=>'El campo Nombre es obligatorio.',
            'image.mimes'=>'El campo Imagen es obligatorio.',
            'percentage.required'=>'El campo Porcentaje es obligatorio.',
        ]);
        $promotion = new Promotion($data);
        $promotion->name=$request->get('name');
        $promotion->description=$request->get('description');
        $promotion->percentage=$request->get('percentage');
        if(Input::hasFile('image')){
            $file=Input::file('image');
            $file->move(public_path().'/images/promotions/',$file->getClientOriginalName());
            $promotion->image=$file->getClientOriginalName();
        }
        $promotion->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Creó una nueva promoción';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.promotions.index')->withFlash('La promoción ha sido creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        $this->authorize('view', $promotion);
        $promotions = PromotionProduct::all();
        return view('admin.promotions.show', compact('promotion','promotions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        $this->authorize('update', $promotion);
        return view('admin.promotions.edit', compact('promotion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        $this->authorize('update', $promotion);

        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
        ],[
            'name.required'=>'El campo Nombre es obligatorio.',
            'description.required'=>'El campo Descripción es obligatorio.',
        ]);

        if(Input::hasFile('image')){
            $file=Input::file('image');
            $file->move(public_path().'/images/promotions/',$file->getClientOriginalName());
            $promotion->image=$file->getClientOriginalName();
        }
        $promotion->name=$request->get('name');
        $promotion->description=$request->get('description');
        $promotion->percentage=$request->get('percentage');
        $promotion->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Editó una promoción';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.promotions.index', $promotion)->withFlash('Promoción actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        $this->authorize('delete', $promotion);
        $promotion->delete();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Eliminó una promoción';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.promotions.index')->withFlash('La promoción ha sido eliminada');
    }
}
