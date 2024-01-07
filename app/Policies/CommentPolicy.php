<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function checkUpdateComment(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }
    
    public function checkDeleteComment(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }
}
