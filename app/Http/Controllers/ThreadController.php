<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreThreadRequest;
use App\Http\Resources\ThreadResource;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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

        $thread['user_id'] = auth()->user();

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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thread  $thread
     * @return Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thread  $thread
     * @return Response
     */
    public function destroy(Thread $thread)
    {
        //
    }
}
