<?php

namespace App\Policies;

use App\User;
use App\BranchOffice;
use Illuminate\Auth\Access\HandlesAuthorization;

class BranchOfficePolicy
{
    use HandlesAuthorization;

    public function before($user){
        if($user->hasRole('Administrador')){
            return true;
        }
    }
    
    /**
     * Determine whether the user can view any branch offices.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the branch office.
     *
     * @param  \App\User  $user
     * @param  \App\BranchOffice  $branchOffice
     * @return mixed
     */
    public function view(User $user, BranchOffice $branchOffice)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Ver sucursales');
    }

    /**
     * Determine whether the user can create branch offices.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Crear sucursales');
    }

    /**
     * Determine whether the user can update the branch office.
     *
     * @param  \App\User  $user
     * @param  \App\BranchOffice  $branchOffice
     * @return mixed
     */
    public function update(User $user, BranchOffice $branchOffice)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Actualizar sucursales');
    }

    /**
     * Determine whether the user can delete the branch office.
     *
     * @param  \App\User  $user
     * @param  \App\BranchOffice  $branchOffice
     * @return mixed
     */
    public function delete(User $user, BranchOffice $branchOffice)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Eliminar sucursales');
    }

    /**
     * Determine whether the user can restore the branch office.
     *
     * @param  \App\User  $user
     * @param  \App\BranchOffice  $branchOffice
     * @return mixed
     */
    public function restore(User $user, BranchOffice $branchOffice)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the branch office.
     *
     * @param  \App\User  $user
     * @param  \App\BranchOffice  $branchOffice
     * @return mixed
     */
    public function forceDelete(User $user, BranchOffice $branchOffice)
    {
        //
    }
}
