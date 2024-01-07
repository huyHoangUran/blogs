<?php

namespace App\Services\Admin;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Collection;

class DashboardService
{
    public function getTopLikeComment(string $sortBy): Collection
    {
        try {
            $query = Blog::select('id', 'title')
                ->where('status', Blog::STATUS_ACTIVE);
            if ($sortBy === 'comments') {
                $query->withCount('comments')
                    ->orderByDesc('comments_count');
            } else {
                $query->withCount('likes')
                ->orderByDesc('likes_count');
            }
            return $query
                ->limit(config('length.max_results'))
                ->get();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
