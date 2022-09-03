<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Thread;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Thread $thread)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommentRequest $request
     * @param Thread $thread
     * @return CommentResource
     */
    public function store(StoreCommentRequest $request, Thread $thread): CommentResource
    {
        $comment = $request->validated();

        $comment['thread_id'] = $thread->id;

        return new CommentResource(Comment::create($comment));
    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @return CommentResource
     */
    public function show(Comment $comment): CommentResource
    {
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCommentRequest $request
     * @param Comment $comment
     * @return CommentResource
     */
    public function update(StoreCommentRequest $request, Comment $comment): CommentResource
    {
        $comment->update($request->validated());

        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return JsonResponse
     */
    public function destroy(Comment $comment): JsonResponse
    {
        $result = $comment->delete();

        return response()->json([
            'status' => $result,
            'message' => $result ? 'success' : 'failed'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return CommentResource
     * @throws AuthorizationException
     */
    public function publish(Comment $comment): CommentResource
    {
        $this->authorize('changeVisibility', [Comment::class, $comment]);

        $comment->visible = !$comment->visible;

        $comment->update();

        return new CommentResource($comment);
    }
}
