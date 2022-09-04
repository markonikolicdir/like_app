<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreThreadRequest;
use App\Http\Resources\ThreadResource;
use App\Models\Thread;
use App\Services\RedditService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    public function __construct(private RedditService $redditService)
    {
        $this->authorizeResource(Thread::class, 'thread');
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ThreadResource::collection(Thread::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreThreadRequest $request
     * @return JsonResource
     */
    public function store(StoreThreadRequest $request): JsonResource
    {
        $thread = $request->validated();

        $thread['user_id'] = Auth::id();

        return new ThreadResource(Thread::create($thread));
    }

    /**
     * Display the specified resource.
     *
     * @param Thread $thread
     * @return JsonResource
     */
    public function show(Thread $thread): JsonResource
    {
        return new ThreadResource($thread);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreThreadRequest $request
     * @param Thread $thread
     * @return JsonResource
     */
    public function update(StoreThreadRequest $request, Thread $thread): JsonResource
    {
        $thread->update($request->validated());

        return new ThreadResource($thread);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Thread $thread
     * @return JsonResponse
     */
    public function destroy(Thread $thread): JsonResponse
    {
        $result = $thread->delete();

        return response()->json([
            'status' => $result,
            'message' => $result ? 'success' : 'failed'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Thread $thread
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function liveReddit(Thread $thread): JsonResponse
    {
        $this->authorize('liveReddit', [$thread]);

        $result = $this->redditService->publishToReddit($thread);

        return response()->json([
            'status' => $result,
            'message' => $result ? 'success' : 'failed'
        ]);
    }
}
