<?php

namespace App\Policies;

use App\Models\Album;
use App\Models\User;

class AlbumPolicy
{
    public function before(User $user)
    {
        if ($user->role === 'super admin')  return true;
    }
    /**
     * Create a new policy instance.
     */
    public function superAdminAlbumAccess(User $user, Album $album)
    {
        return !$album->service;
    }
}
