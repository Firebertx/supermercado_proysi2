<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Category;
use App\Customer;
use App\Paypal;
use App\Pedido;
use App\ShoppingCart;
use App\Solicitud;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShoppingCartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shopping_cart_id = \Session::get('shopping_cart_id');
        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);

        //$paypal=new Paypal($shopping_cart);
        //$payment = $paypal->generate();

        //return redirect($payment->getApprovalLink());

        $categories=Category::all();
        $products=$shopping_cart->products()->get();
        $packages=$shopping_cart->packages()->get();
        $total = $shopping_cart->totalUSD();
        //return view('layouts.app',compact('products','packages','total'));
        $pedidos=Pedido::all();
        return view('shopping_carts.index',compact('products','packages','total', 'categories', 'pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pay(){
        $shopping_cart_id = \Session::get('shopping_cart_id');
        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);

        $paypal=new Paypal($shopping_cart);
        $payment = $paypal->generate();

        return redirect($payment->getApprovalLink());
    }


    public function create()
    {
        $shopping_cart_id = \Session::get('shopping_cart_id');
        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);

        $categories=Category::all();
        $products=$shopping_cart->products()->get();
        $packages=$shopping_cart->packages()->get();
        $total = $shopping_cart->totalUSD();
        return view('shopping_carts.create',compact('products','packages','total', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|unique:customers',
            'last_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email|max:255|unique:customers',
            'password' => 'required',
        ],[
            'name.required'=>'El campo Nombre es obligatorio.',
            'last_name.required'=>'El campo Apellido es obligatorio.',
            'phone.required'=>'El campo Teléfono es obligatorio.',
            'address.required'=>'El campo Dirección es obligatorio.',
            'email.required'=>'El campo Email es obligatorio.',
            'password.required'=>'El campo Password es obligatorio.',
        ]);

        $user = new User($data);
        $user->name=$request->get('name');
        $user->last_name=$request->get('last_name');
        $user->sex=$request->get('sex');
        $user->nationality=$request->get('nationality');
        $user->address=$request->get('address');
        $user->city=$request->get('city');
        $user->phone=$request->get('phone');
        $user->email=$request->get('email');
        $user->password=$request->get('password');
        $user->type='Cliente';
        if($request->hasFile('photo')){
            $user->photo=$request->file('photo')->store('public/users');
        }
        return $user;
        $user->save();

        $customer = new Customer();
        $customer->user_id=$user->id;
        $customer->latitude=$request->get('lat');
        $customer->length=$request->get('lng');
        $customer->save();

        $now=Carbon::now('America/La_Paz');
        $shopping_cart_id = \Session::get('shopping_cart_id');
        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);

        $solicitud = new Solicitud();
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

        return redirect()->route('dashboard')->withFlash('SOLICITUD REALIZADA CON EXITO... PRONTO SE LE NOTIFICARA LA ACEPTACIÓN');
        //return redirect()->route('admin.customers.index')->withFlash('El cliente ha sido creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
