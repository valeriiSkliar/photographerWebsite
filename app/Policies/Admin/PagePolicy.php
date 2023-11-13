<?php

namespace App\Policies\Admin;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use App\Models\Page;
use App\Models\User;

class PagePolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */

    public function before(User $user)
    {
        if ($user->role === 'super admin') {
            return true;
        }
    }
    public function viewAny(User $user): bool
    {
        return $user->role ==='super admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Page $page): bool
    {
        return $page->role ==='super admin';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role ==='super admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Page $page): bool
    {
        return $user->role ==='super admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Page $page): bool
    {
        return $user->role ==='super admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Page $page): bool
    {
        return $user->role ==='super admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Page $page): bool
    {
        return $user->role ==='super admin';
    }
}
