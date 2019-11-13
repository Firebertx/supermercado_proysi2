<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Customer;
use App\Events\UserWasCreated;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', new Customer());

        return view('admin.customers.index',[
            'customers'=>Customer::all(),
            'users'=>User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', new Customer());

        $user= new User;
        $customer= Customer::all();
        $roles=Role::with('permissions')->get();
        $permissions=Permission::pluck('name','id');
        return view('admin.customers.create', compact('user','roles', 'permissions','customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Customer);

        //validar el formulario
        $data = $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'sex'=>'max:1',
            'address'=>'required',
            'city'=>'required',
            'phone'=>'required',
            'email' => 'required|email|max:255|unique:users',
            'location'=>'required',
            'lat'=>'required',
            'lng'=>'required',
        ],[
            'name.required'=>'El campo Nombre es obligatorio.',
            'last_name.required'=>'El campo Apellido es obligatorio.',
            'sex.max'=>'El campo Sexo no debe contener más de 1 caracteres.',
            'address.required'=>'El campo Dirección es obligatorio.',
            'city.required'=>'El campo Ciudad es obligatorio.',
            'phone.required'=>'El campo Teléfono es obligatorio.',
            'email.required'=>'El campo Email es obligatorio.',
            'location.required'=>'El campo Ubicación es obligatorio.',
            'lat.required'=>'El campo Latitud es obligatorio.',
            'lng.required'=>'El campo Longitud es obligatorio.',
        ]);

        $data['password']=str_random(8);
        $user = new User($data);
        if(Input::hasFile('photo')){
            $file=Input::file('photo');
            $file->move(public_path().'/images/customers/',$file->getClientOriginalName());
            $user->photo=$file->getClientOriginalName();
        }
        $user->name=$request->get('name');
        $user->last_name=$request->get('last_name');
        $user->sex=$request->get('sex');
        $user->city=$request->get('city');
        $user->nationality=$request->get('nationality');
        $user->address=$request->get('address');
        $user->phone=$request->get('phone');
        $user->email=$request->get('email');
        $user->type='Cliente';
        $user->save();

        $customer=new Customer();
        $customer->user_id=$user->id;
        $customer->location=$request->get('location');
        $customer->city=$request->get('city');
        $customer->latitude=$request->get('lat');
        $customer->length=$request->get('lng');
        $customer->save();

        //Asignar roles
        $user->assignRole($request->roles);

        //Asignar permisos
        $user->givePermissionTo($request->permissions);

        //Enviamos el Email
        UserWasCreated::dispatch($user, $data['password']);

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Registro un nuevo Cliente';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.customers.index')->withFlash('El cliente ha sido registrado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $this->authorize('view', $customer);
        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $this->authorize('update', $customer);

        $roles=Role::with('permissions')->get();
        return view('admin.customers.edit', compact('customer','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $this->authorize('update', $customer);

        //$customer->city=$request->get('city');
        $customer->location=$request->get('location');
        $customer->latitude=$request->get('lat');
        $customer->length=$request->get('lng');
        $customer->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Editó una información de un cliente';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.customers.edit',$customer)->withFlash('El cliente ha sido actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $this->authorize('delete', $customer);

        $customer->user()->delete();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Eliminó un cliente';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.customers.index')->withFlash('El cliente ha sido eliminado');
    }
}
