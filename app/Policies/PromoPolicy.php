<?php

namespace App\Policies;

use App\User;
use App\Promo;
use Illuminate\Auth\Access\HandlesAuthorization;

class PromoPolicy
{
    use HandlesAuthorization;

    public function before($user){
        if($user->hasRole('Administrador')){
            return true;
        }
    }
    
    /**
     * Determine whether the user can view any promos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the promo.
     *
     * @param  \App\User  $user
     * @param  \App\Promo  $promo
     * @return mixed
     */
    public function view(User $user, Promo $promo)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Ver promociones');
    }

    /**
     * Determine whether the user can create promos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Crear promociones');
    }

    /**
     * Determine whether the user can update the promo.
     *
     * @param  \App\User  $user
     * @param  \App\Promo  $promo
     * @return mixed
     */
    public function update(User $user, Promo $promo)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Actualizar promociones');
    }

    /**
     * Determine whether the user can delete the promo.
     *
     * @param  \App\User  $user
     * @param  \App\Promo  $promo
     * @return mixed
     */
    public function delete(User $user, Promo $promo)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Eliminar promociones');
    }

    /**
     * Determine whether the user can restore the promo.
     *
     * @param  \App\User  $user
     * @param  \App\Promo  $promo
     * @return mixed
     */
    public function restore(User $user, Promo $promo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the promo.
     *
     * @param  \App\User  $user
     * @param  \App\Promo  $promo
     * @return mixed
     */
    public function forceDelete(User $user, Promo $promo)
    {
        //
    }
}
