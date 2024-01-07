<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Admin\BlogService;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    const PATH_VIEW = 'admin.blogs.';

    public function __construct(
        private BlogService $blogService,
    ) {
    }

    public function list(Request $request)
    {
        $filters = $request->only('status', 'date');
        $blogs = $this->blogService->index($filters);
        return view(self::PATH_VIEW . __FUNCTION__, compact('blogs'));
    }
}
