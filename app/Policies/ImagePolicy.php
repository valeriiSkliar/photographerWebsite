<?php

namespace App\Policies;

use App\Models\Image;
use App\Models\User;

class ImagePolicy
{
        public function before(User $user)
    {
        if ($user->role === 'super admin')  return true;
    }
        /**
         * Create a new policy instance.
         */
        public function superAdminImageAccess(User $user, Image $image)
    {
        if ($album = optional($image->albums->first())) {
            return !$album->service;
        }
    }
}
