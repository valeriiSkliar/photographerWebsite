<?php

namespace App\Policies\Roles;

use App\Models\Album;
use Illuminate\Auth\Access\Response;
use App\Models\User;

class AdminPolicy
{
    public function before(User $user)
    {
        if ($user->role === 'super admin')  return true;
    }
    /**
     * Determine whether the user can view any models.
     */

    public function  superAdminAccess(User $user)
    {
        return $user->role === 'super admin';
    }
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return $model->role === 'admin';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        //
    }
}
