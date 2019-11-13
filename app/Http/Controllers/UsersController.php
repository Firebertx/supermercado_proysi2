<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\BranchOffice;
use App\Customer;
use App\Employee;
use App\Events\UserWasCreated;
use App\Provider;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::allowed()->get();
        return view('admin.users.index',compact('users'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user= new User;
        $this->authorize('create', $user);

        $employees=Employee::all();
        $branchOffices=BranchOffice::all();
        $roles=Role::with('permissions')->get();
        $permissions=Permission::pluck('name','id');
        return view('admin.users.create', compact('user','roles', 'permissions','employees','branchOffices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new User);

        //validar el formulario
        $data = $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'sex'=>'max:1',
            'address'=>'required',
            'phone'=>'required',
            'email' => 'required|email|max:255|unique:users',
            'code' => 'unique:employees',
            'nit' => 'unique:providers',
        ],[
            'name.required'=>'El campo Nombre es obligatorio.',
            'last_name.required'=>'El campo Apellido es obligatorio.',
            'address.required'=>'El campo Dirección es obligatorio.',
            'phone.required'=>'El campo Teléfono es obligatorio.',
            'email.required'=>'El campo Email es obligatorio.',
            'sex.max'=>'El campo Sexo no debe contener más de 1 caracteres.',
            'code.unique'=>'El campo Código ya existe.',
            'nit.unique'=>'El campo NIT ya existe.',
        ]);

        //Generar una contraseña
        $data['password']=str_random(8);

        //Crear al usuario
        //$user = User::create($data);
        $user = new User($data);
        $user->name=$request->get('name');
        $user->last_name=$request->get('last_name');
        $user->sex=$request->get('sex');
        $user->city=$request->get('city');
        $user->nationality=$request->get('nationality');
        $user->address=$request->get('address');
        $user->phone=$request->get('phone');
        $user->email=$request->get('email');
        if(Input::hasFile('photo')){
            $file=Input::file('photo');
            $file->move(public_path().'/images/users/',$file->getClientOriginalName());
            $user->photo=$file->getClientOriginalName();
        }
        $user->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Creó un nuevo usuario';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        //Asignar roles
        $user->assignRole($request->roles);

        //Asignar permisos
        $user->givePermissionTo($request->permissions);

        //Enviamos el Email
        UserWasCreated::dispatch($user, $data['password']);

        if ($request->get('code') && $request->get('branchOffice')){
            $employee=new Employee();
            $employee->user_id=$user->id;
            $employee->code=$request->get('code');
            $employee->branchOffice_id=$request->get('branchOffice');
            $employee->save();
            return redirect()->route('admin.employees.index')->withFlash('El empleado ha sido creado');
        }elseif ($request->get('nit')){
            $provider=new Provider();
            $provider->user_id=$user->id;
            $provider->nit=$request->get('nit');
            $provider->save();
            return redirect()->route('admin.providers.index')->withFlash('El proveedor ha sido creado');
        }else{
            $customer=new Customer();
            $customer->user_id=$user->id;
            $customer->city=$request->get('city');
            $customer->save();

            return redirect()->route('admin.customers.index')->withFlash('El cliente ha sido creado');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //$this->authorize('view', $user);
        $customers=Customer::all();
        $employees=Employee::all();
        $providers=Provider::all();

        foreach ($customers as $customer) {
            if ($customer->user_id === \auth()->user()->id) {
                return view('admin.customers.show', compact('user'));
            }
        }
        foreach ($employees as $employee){
            if ($employee->user_id === \auth()->user()->id){
                return view('admin.employees.show', compact('user'));
            }
        }
        foreach ($providers as $provider){
            if ($provider->user_id === \auth()->user()->id){
                return view('admin.employees.show', compact('user'));
            }
        }
        //return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        $this->authorize('update', $user);
        //$roles=Role::pluck('name','id');
        $roles=Role::with('permissions')->get();
        $permissions=Permission::pluck('name','id');
        $employees=Employee::all();
        $branchOffices=BranchOffice::all();

        return view('admin.users.edit', compact('user','roles', 'permissions','employees','branchOffices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        if(Input::hasFile('photo')){
            $file=Input::file('photo');
            if($user->type=='Empleado'){
                $file->move(public_path().'/images/employees/',$file->getClientOriginalName());
            }elseif($user->type=='Proveedor'){
                $file->move(public_path().'/images/providers/',$file->getClientOriginalName());
            }else{
                $file->move(public_path().'/images/customers/',$file->getClientOriginalName());
            }
            $user->photo=$file->getClientOriginalName();
        }
        $user->name=$request->get('name');
        $user->last_name=$request->get('last_name');
        $user->sex=$request->get('sex');
        $user->nationality=$request->get('nationality');
        $user->address=$request->get('address');
        $user->phone=$request->get('phone');
        $user->email=$request->get('email');
        $user->update($request->validated());

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Editó un usuario';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        if ($user->hasRole('Cliente')){
            return redirect()->route('admin.customers.index')->withFlash('Cliente actualizado');
        }elseif ($user->hasRole('Administrador') || $user->hasRole('Empleado') || $user->hasRole('Encargado de almacen') || $user->hasRole('Limpieza')){
            return redirect()->route('admin.employees.index')->withFlash('Empleado actualizado');
        }elseif ($user->hasRole('Proveedor')){
            return redirect()->route('admin.providers.index')->withFlash('Usuario actualizado');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete',$user);
        $user->delete();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Eliminó un usuario';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.users.index')->withFlash('El usuario ha sido eliminado');
    }
}
