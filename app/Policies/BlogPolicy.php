<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;

class BlogPolicy
{

    /**
     * Determine whether the user can update the model.
     */
    public function checkUpdate(User $user, Blog $blog): bool
    {
        return ($user->id === $blog->user_id || $user->role === User::ADMIN_ROLE);
    }

    public function checkDelete(User $user, Blog $blog): bool
    {
        return ($user->id === $blog->user_id || $user->role === User::ADMIN_ROLE);
    }
}
