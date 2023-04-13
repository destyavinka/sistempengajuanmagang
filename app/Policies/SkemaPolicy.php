<?php

namespace App\Policies;

use App\Models\Skema;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SkemaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Skema  $skema
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Skema $skema)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Skema  $skema
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Skema $skema)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Skema  $skema
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Skema $skema)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Skema  $skema
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Skema $skema)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Skema  $skema
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Skema $skema)
    {
        //
    }
}
