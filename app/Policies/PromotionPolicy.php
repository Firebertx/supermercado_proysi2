<?php

namespace App\Policies;

use App\User;
use App\Promotion;
use Illuminate\Auth\Access\HandlesAuthorization;

class PromotionPolicy
{
    use HandlesAuthorization;

    public function before($user){
        if($user->hasRole('Administrador')){
            return true;
        }
    }

    /**
     * Determine whether the user can view any promotions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the promotion.
     *
     * @param  \App\User  $user
     * @param  \App\Promotion  $promotion
     * @return mixed
     */
    public function view(User $user, Promotion $promotion)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Ver promociones');
    }

    /**
     * Determine whether the user can create promotions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Crear promociones');
    }

    /**
     * Determine whether the user can update the promotion.
     *
     * @param  \App\User  $user
     * @param  \App\Promotion  $promotion
     * @return mixed
     */
    public function update(User $user, Promotion $promotion)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Actualizar promociones');
    }

    /**
     * Determine whether the user can delete the promotion.
     *
     * @param  \App\User  $user
     * @param  \App\Promotion  $promotion
     * @return mixed
     */
    public function delete(User $user, Promotion $promotion)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Eliminar promociones');
    }

    /**
     * Determine whether the user can restore the promotion.
     *
     * @param  \App\User  $user
     * @param  \App\Promotion  $promotion
     * @return mixed
     */
    public function restore(User $user, Promotion $promotion)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the promotion.
     *
     * @param  \App\User  $user
     * @param  \App\Promotion  $promotion
     * @return mixed
     */
    public function forceDelete(User $user, Promotion $promotion)
    {
        //
    }
}
