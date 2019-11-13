<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\BranchOffice;
use App\Employee;
use App\Events\UserWasCreated;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee= new Employee();
        $this->authorize('view', $employee);

        $users = User::all();
        $employees=Employee::all();
        return view('admin.employees.index',compact('employees', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee= new Employee();
        $this->authorize('create', $employee);

        $user= new User;
        $employees=Employee::all();
        $branchOffices=BranchOffice::all();
        $roles=Role::with('permissions')->get();
        $permissions=Permission::pluck('name','id');
        return view('admin.employees.create', compact('user','roles', 'permissions','employees','branchOffices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee= new Employee();
        $this->authorize('create', $employee);

        //validar el formulario
        $data = $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'sex'=>'max:1',
            'address'=>'required',
            'phone'=>'required',
            'email' => 'required|email|max:255|unique:users',
            'code' => 'required|unique:employees',
        ],[
            'name.required'=>'El campo Nombre es obligatorio.',
            'last_name.required'=>'El campo Apellido es obligatorio.',
            'address.required'=>'El campo Dirección es obligatorio.',
            'phone.required'=>'El campo Teléfono es obligatorio.',
            'email.required'=>'El campo Email es obligatorio.',
            'sex.max'=>'El campo Sexo no debe contener más de 1 caracteres.',
            'code.required'=>'El campo Código es obligatorio.',
        ]);

        //Generar una contraseña
        $data['password']=str_random(8);

        //Crear al usuario
        //$user = User::create($data);
        $user = new User($data);
        if(Input::hasFile('photo')){
            $file=Input::file('photo');
            $file->move(public_path().'/images/employees/',$file->getClientOriginalName());
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
        $user->type='Empleado';
        $user->save();

        $employee=new Employee();
        $employee->user_id=$user->id;
        $employee->code=$request->get('code');
        $employee->branchOffice_id=$request->get('branchOffice');
        $employee->save();

        //Asignar roles
        $user->assignRole($request->roles);

        //Asignar permisos
        $user->givePermissionTo($request->permissions);

        //Enviamos el Email
        UserWasCreated::dispatch($user, $data['password']);

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Registro un nuevo Empleado';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.employees.index')->withFlash('El empleado ha sido creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $this->authorize('view', $employee);

        return view('admin.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $this->authorize('update', $employee);

        $roles=Role::with('permissions')->get();
        $permissions=Permission::pluck('name','id');
        $branchOffices=BranchOffice::all();
        return view('admin.employees.edit', compact('employee','branchOffices','roles','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $this->authorize('update', $employee);

        $employee->code=$request->get('code');
        $employee->branchOffice_id=$request->get('branchOffice');
        $employee->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Editó una información de un empleado';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.employees.edit',$employee)->withFlash('Empleado actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $this->authorize('delete',$employee);

        $employee->user()->delete();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Eliminó un empleado';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.employees.index')->withFlash('El empleado ha sido eliminado');
    }
}
