<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Customer;
use App\InShoppingCart;
use App\Package;
use App\Pedido;
use App\Product;
use App\ShoppingCart;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->authorize('view',new Pedido());
        $pedidos=Pedido::all();
        $customers=Customer::all();
        $users=User::all();
        return view('admin.pedidos.index', compact('pedidos','customers','users'));
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
        //$this->authorize('create',new Pedido());
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
        $customer->location=$request->get('location');
        $customer->city=$request->get('city');
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

        $pedido = new Pedido($data2);
        $pedido->shopping_cart_id=$shopping_cart->id;
        $pedido->customer_id=$customer->id;
        $pedido->state='Pendiente';
        $pedido->order_date =$now->toDateTimeString();
        $pedido->date =$request->get('date');
        $pedido->hour =$request->get('hour');
        $pedido->total=$shopping_cart->totalUSD();
        $pedido->save();

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
    public function show(Pedido $pedido)
    {
        $packages=Package::all();
        $products = Product::all();
        $customers=Customer::all();
        $users=User::all();
        $inshoppingcarts=InShoppingCart::all();
        return view('admin.pedidos.show', compact('pedido','customers','packages','products','inshoppingcarts','users'));
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
    public function update(Request $request, Pedido $pedido)
    {
        if ($request->get('state')=='Aceptado'){
            $pedido->state = 'Aceptado';
            $pedido->save();

            $bitacora = new Bitacora();
            $bitacora->user = Auth::user()->name;
            $bitacora->last_name = Auth::user()->last_name;
            $bitacora->action = 'Acepto un pedido';
            $now=Carbon::now('America/La_Paz');
            $bitacora->date =$now->toDateTimeString();
            $bitacora->hour =$now->toDateTimeString();
            $bitacora->save();

            return redirect()->route('admin.pedidos.index')->withFlash('El pedido ha sido aceptado');

        }elseif ($request->get('state')=='Rechazado'){
            $pedido->state = 'Rechazado';
            $pedido->save();

            $bitacora = new Bitacora();
            $bitacora->user = Auth::user()->name;
            $bitacora->last_name = Auth::user()->last_name;
            $bitacora->action = 'Rechazó un pedido';
            $now=Carbon::now('America/La_Paz');
            $bitacora->date =$now->toDateTimeString();
            $bitacora->hour =$now->toDateTimeString();
            $bitacora->save();

            return redirect()->route('admin.pedidos.index')->withFlash('El pedido ha sido rechazado');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
