<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Services\User\BlogService;
use App\Services\User\CommentService;
use App\Services\User\CategoryService;

class BlogController extends Controller
{
    
    const PATH_VIEW = 'blogs.';

    public function __construct(
        private CategoryService $categoryService,
        private BlogService $blogService,
        private CommentService $commentService
    ) {
    }

    /**
     * Show the form for creating a new resource.
     */

    public function home(Request $request)
    {
        $categories = $this->categoryService->getAll();
        $data = $request->only('search', 'category_id');
        $blogs = $this->blogService->index($data);
        return view(self::PATH_VIEW . __FUNCTION__, compact('blogs', 'categories', 'data'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAll();
        return view(self::PATH_VIEW.__FUNCTION__, compact('categories'));
    }
    
    public function store(BlogRequest $request)
    {
        $this->blogService->store($request->only('title', 'content', 'category_id', 'img'));
        return redirect()->route('home')->with('success', __('blog.blog_created'));
    }

    public function show(Blog $blog)
    {
        $relatedBlogs = $this->blogService->show($blog->id);
        $blog = $this->blogService->loadBlog($blog);
        $liked = auth()->check() ? $blog->likes()->where('user_id', auth()->id())->exists() : false;
        return view(self::PATH_VIEW.__FUNCTION__, compact('blog', 'relatedBlogs', 'liked'));
    }

    public function edit(Blog $blog)
    {
        $this->authorize('checkUpdate', $blog);
        $categories = $this->categoryService->getAll();
        return view(self::PATH_VIEW.__FUNCTION__, compact('blog', 'categories'));
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        $this->authorize('checkUpdate', $blog);
        $this->blogService->update($request, $blog);
        return redirect()->route('blogs.show', $blog)->with('succcess', __('blog.blog_updated'));
    }

    public function destroy(Blog $blog)
    {
        $this->authorize('checkDelete', $blog);
        $this->blogService->delete($blog);
        return redirect()->route('home')->with('success', __('blog.blog_deleted'));
    }

    public function approved(Blog $blog, User $user)
    {
        $this->authorize('isAdmin', $user);
        $this->blogService->approvedBlog($blog);
        return back()->with('success', 'Completed to approve');
    }
}
