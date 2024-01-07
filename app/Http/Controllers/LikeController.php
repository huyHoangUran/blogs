<?php

namespace App\Http\Controllers;

use App\Services\User\LikeService;

class LikeController extends Controller
{
    public function __construct(private LikeService $likeService)
    {
    }

    public function like(int $blogId)
    {
        $liked = $this->likeService->like($blogId);
        return response()->json(['liked' => $liked], 200);
    }
}
