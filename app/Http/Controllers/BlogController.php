<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Blog;
use App\Models\User;
use App\Models\Banner;
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

    public function home()
    {
        $banners = Banner::all();
        $adsVip = Ads::where('status', 1)->latest()->get();
        $ads = Ads::where('status', 2)->latest()->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('banners', 'adsVip', 'ads'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAlls();
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
