<?php
namespace App\Services\User;

use Exception;
use App\Models\Comment;

class CommentService
{
    public function store(array $data, int $blogId): Comment
    {
        try {
            return Comment::create([
                    'user_id' => auth()->user()->id,
                    'blog_id' => $blogId,
                    'content' => $data['content'],
                ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(array $data, Comment $comment): bool
    {
        try {
            return $comment->update([
                    'content' => $data['content'],
                ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function destroy(Comment $comment): bool
    {
        try {
            return $comment->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
