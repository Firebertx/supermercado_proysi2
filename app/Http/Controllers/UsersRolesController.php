<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class UsersRolesController extends Controller
{
    public function update(Request $request, User $user)
    {
        $data= $request->roles;
        $user->syncRoles($data);

        return back()->withFlash('Los roles han sido actualizado');
    }
}
