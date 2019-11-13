<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\_EntryProduct;
use App\Customer;
use App\DetalleIngreso;
use App\Events\UserWasCreated;
use App\Provider;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', new Provider());

        $users = User::all();
        $providers=Provider::all();
        return view('admin.providers.index',compact('users','providers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', new Provider());

        $user= new User;
        $roles=Role::with('permissions')->get();
        $permissions=Permission::pluck('name','id');
        return view('admin.providers.create', compact('user','roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Provider());

        //validar el formulario
        $data = $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'sex'=>'max:1',
            'address'=>'required',
            'phone'=>'required',
            'email' => 'required|email|max:255|unique:users',
            'nit' => 'required|unique:providers',
        ],[
            'name.required'=>'El campo Nombre es obligatorio.',
            'last_name.required'=>'El campo Apellido es obligatorio.',
            'address.required'=>'El campo Dirección es obligatorio.',
            'phone.required'=>'El campo Teléfono es obligatorio.',
            'email.required'=>'El campo Email es obligatorio.',
            'sex.max'=>'El campo Sexo no debe contener más de 1 caracteres.',
            'nit.required'=>'El campo NIT es obligatorio.',
        ]);

        $data['password']=str_random(8);
        $user = new User($data);
        if(Input::hasFile('photo')){
            $file=Input::file('photo');
            $file->move(public_path().'/images/providers/',$file->getClientOriginalName());
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
        $user->type='Proveedor';
        $user->save();

        $provider=new Provider();
        $provider->user_id=$user->id;
        $provider->nit=$request->get('nit');
        $provider->save();

        //Asignar roles
        $user->assignRole('Proveedor');

        //Asignar permisos
        $user->givePermissionTo($request->permissions);

        //Enviamos el Email
        UserWasCreated::dispatch($user, $data['password']);

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Registró un nuevo proveedor';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.providers.index')->withFlash('El proveedor ha sido registrado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        $this->authorize('view', $provider);
        $detalleIngresos=DetalleIngreso::all();
        $users=User::all();
        $customers=Customer::all();
        return view('admin.providers.show', compact('provider','detalleIngresos','users','customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        $this->authorize('update', $provider);

        $roles=Role::with('permissions')->get();
        $permissions=Permission::pluck('name','id');
        return view('admin.providers.edit', compact('provider','roles','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        $this->authorize('update', $provider);

        $provider->nit=$request->get('nit');
        $provider->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Editó un proveedor';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.providers.edit',$provider)->withFlash('El proveedor ha sido actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        $this->authorize('delete', $provider);
        $provider->user()->delete();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Eliminó un proveedor';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.providers.index')->withFlash('El proveedor ha sido eliminado');
    }
}
