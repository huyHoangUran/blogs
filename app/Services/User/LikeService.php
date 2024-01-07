<?php

namespace App\Services\User;

use Exception;
use App\Models\Blog;

class LikeService
{
    public function like(int $blogId): int
    {
        try {
            $user = auth()->user();
            $blog = Blog::find($blogId);
            $blog->likes()->toggle($user->id);
            return $blog->likes()->count();
        } catch (Exception $e) {
            throw new Exception($ex->getMessage());
        }
    }
}
