<?php

use App\Http\Controllers\Web\ThreadController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/auth/redirect', function () {
    return Socialite::driver('reddit')
        ->scopes(['identity', 'submit'])
        ->redirect();
});

Route::get('/auth/callback', function () {
    $redditUser = Socialite::driver('reddit')->user();

    /** @var User $user */
    $user = User::updateOrCreate([
        'reddit_id' => $redditUser->getId(),
    ], [
        'name' => $redditUser->getNickname(),
        'reddit_id' => $redditUser->getId()
    ]);

    // Use this token for Bearer authorization api calls
    var_dump($user->createToken('API Token')->plainTextToken);

    // User this for reddit live api, save it in db
    var_dump($redditUser->token);

    Auth::login($user);
});

Route::get('/auth/logout', function () {
    Auth::logout();
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('threads', [ThreadController::class, 'index']);
    Route::get('threads/nested', [ThreadController::class, 'nested']);
});
