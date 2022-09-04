<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ThreadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('threads', ThreadController::class);

    Route::post('threads/{thread}/live-reddit', [ThreadController::class, 'liveReddit']);

    Route::resource('threads.comments', CommentController::class)->shallow();

    Route::patch('comments/{comment}/publish', [CommentController::class, 'publish']);

    Route::post('comments/{comment}/reply', [CommentController::class, 'reply']);
});
