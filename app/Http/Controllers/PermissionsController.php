<?php

namespace App\Http\Controllers;

use App\Bitacora;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function index()
    {
        $this->authorize('view', new Permission);
        return view('admin.permissions.index',[
            'permissions'=>Permission::all()
        ]);
    }

    public function edit(Permission $permission)
    {
        $this->authorize('update', new Permission);
        return view('admin.permissions.edit',[
            'permission'=>$permission
        ]);
    }

    public function update(Request $request, Permission $permission)
    {
        $this->authorize('update',$permission);
        $data = $request->validate([
            'name'=>'required'],[
            'name.required'=>'El campo Nombre es obligatorio.'
        ]);

        $$permission->update($data);

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Editó un permiso';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.permissions.edit',$permission)->withFlash('El permiso has sido modificado');
    }

}
