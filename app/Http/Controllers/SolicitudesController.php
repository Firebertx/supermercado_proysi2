<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Customer;
use App\DetalleIngreso;
use App\Egreso;
use App\Events\UserWasCreated;
use App\InShoppingCart;
use App\Inventory;
use App\Package;
use App\Product;
use App\Provider;
use App\ShoppingCart;
use App\Solicitud;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view',new Solicitud());
        $solicitudes=Solicitud::all();
        $customers=Customer::all();
        $users=User::all();
        return view('admin.solicitudes.index', compact('solicitudes','customers','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',new Solicitud());
        $data = $request->validate([
            'lat' => 'required',
            'lng' => 'required',
            'location' => 'required',
            'city' => 'required',
        ],[
            'lat.required'=>'El campo Latitud es obligatorio.',
            'lng.required'=>'El campo Longitud es obligatorio.',
            'location.required'=>'El campo Ubicación es obligatorio.',
            'city.required'=>'El campo Ciudad es obligatorio.',
        ]);
        $customer = new Customer($data);
        $customer->user_id=Auth::user()->id;
        $customer->latitude=$request->get('lat');
        $customer->length=$request->get('lng');
        $customer->save();

        $now=Carbon::now('America/La_Paz');
        $shopping_cart_id = \Session::get('shopping_cart_id');
        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);


        $data2 = $request->validate([
            'hour' => 'required',
            'date' => 'required',
        ],[
            'hour.required'=>'El campo Hora de Evento es obligatorio.',
            'date.required'=>'El campo Fecha de Evento es obligatorio.',
        ]);

        $solicitud = new Solicitud($data2);
        $solicitud->shopping_cart_id=$shopping_cart->id;
        $solicitud->customer_id=$customer->id;
        $solicitud->state='Pendiente';
        $solicitud->order_date =$now->toDateTimeString();
        $solicitud->date =$request->get('date');
        $solicitud->hour =$request->get('hour');
        $solicitud->total=$shopping_cart->totalUSD();
        $solicitud->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Se ha registrado un nuevo cliente y ha solicitado una compra';
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('dashboard')->withFlash('SOLICITUD REALIZADA CON EXITO... PRONTO SE LE NOTIFICARA UNA RESPUESTA');
        //return redirect()->route('admin.customers.index')->withFlash('El cliente ha sido creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function show(Solicitud $solicitud)
    public function show(Request $request)
    {
        //return $solicitud;
        return $request;
        $packages=Package::all();
        $products = Product::all();
        $customers=Customer::all();
        $users=User::all();
        $inshoppingcarts=InShoppingCart::all();
        return view('admin.solicitudes.show', compact('solicitud','customers','packages','products','inshoppingcarts','users'));
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
    public function destroy(Solicitud $solicitud)
    {
        $solicitud->state='Aceptado';
        $solicitud->save();

        return redirect()->route('admin.solicitudes.index')->withFlash('La solicitud ha sido aceptada');
    }
}
