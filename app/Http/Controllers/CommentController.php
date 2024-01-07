<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use App\Services\User\CommentService;

class CommentController extends Controller
{

    public function __construct(private CommentService $commentService)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request, int $blogId)
    {
        $user = auth()->user();
        $response = $this->commentService->store($request->only('content'), $blogId);
        return response()->json(['data' => $response, 'user' => $user]);
    }

    public function update(CommentRequest $request, int $id)
    {
        $comment = Comment::findOrFail($id);
        $this->authorize('checkUpdateComment', $comment);
        $response = $this->commentService->update($request->only('content'), $comment);
        return json_encode(['data' => $response]);
    }

    public function destroy(int $id)
    {
        $comment = Comment::findOrFail($id);
        $this->authorize('checkDeleteComment', $comment);
        $response = $this->commentService->destroy($comment);
        return json_encode(['data' => $response]);
    }
}
