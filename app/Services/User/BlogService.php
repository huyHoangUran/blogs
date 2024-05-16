<?php

namespace App\Services\User;

use Exception;
use App\Models\Blog;
use App\Models\User;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BlogService
{
    const PATH_UPLOAD = 'public/images';

    public function index(array $data): LengthAwarePaginator
    {
        try {
            $query = Blog::with('user')
                ->where('status', Blog::STATUS_ACTIVE)
                ->orderBy('created_at', 'DESC');
            
            if (data_get($data, 'search')) {
                $query->where('title', 'like', '%' . $data['search'] . '%');
            }
            if (data_get($data, 'category_id')) {
                $query->where('category_id', $data['category_id']);
            }
            return $query->paginate(config('length.paginate'));
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function store(array $data): Blog
    {
        try {
            $imageName = 'images/Rectangle_82.png';
            if (isset($data['img'])) {
                $imageName = $data['img']->store(self::PATH_UPLOAD);
            }
            return Blog::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'category_id' => $data['category_id'],
                'img' => $imageName,
                'user_id' => auth()->user()->id,
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function show(int $id): Collection
    {
        try {
            return Blog::with('category')
                ->where('status', Blog::STATUS_ACTIVE)
                ->where('id', '!=', $id)
                ->inRandomOrder()
                ->limit(4)
                ->get();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(BlogRequest $request, Blog $blog): bool
    {
        try {
            $data = $request->except('img');
            if ($request->hasFile('img')) {
                $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));
                if ($blog->img !== null && Storage::exists($blog->img)) {
                    Storage::delete($blog->img);
                }
            }
            $data['status'] = Blog::STATUS_INACTIVE;
            return $blog->update($data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete(Blog $blog): bool
    {
        try {
            if (!empty($blog->img) && Storage::exists($blog->img)) {
                Storage::delete($blog->img);
            }
            $blog->comments()->delete();
            $blog->likes()->detach();
            return $blog->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function loadBlog(Blog $blog): Blog
    {
        return $blog->load('comments.user');
    }

    public function getMyBlogs(int $id): Collection
    {
        return Blog::with('category')->where('user_id', $id)->select('id', 'title', 'category_id', 'status', 'img', 'updated_at')->get();
    }

    public function getLikedBlogs(User $user): Collection
    {
        return $user->likes()->with('category')->get();
    }

    public function approvedBlog(Blog $blog): bool
    {
        $status = $blog->status == Blog::STATUS_ACTIVE ? Blog::STATUS_INACTIVE : Blog::STATUS_ACTIVE;
        return $blog->update(['status' => $status]);
    }
}
