<?php

namespace App\Services\Admin;

use App\Models\Blog;

class BlogService
{
    public function index(array $filters)
    {
        $query = Blog::with('user', 'category')
            ->select('id', 'title', 'category_id', 'user_id', 'img', 'status', 'created_at');
        if (data_get($filters, 'status')) {
            $query->where('status', $filters['status']);
        }
        if (data_get($filters, 'date')) {
            $query->whereDate('created_at', $filters['date']);
        }
        $blogs = $query->latest()->paginate(5)->appends($filters);
        return $blogs;
    }
}
