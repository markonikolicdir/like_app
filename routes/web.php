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

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/auth/redirect', function () {
    return Socialite::driver('reddit')
        ->scopes(['identity', 'submit'])
        ->redirect();
})->name('redirect');

Route::get('/auth/callback', function () {
    $redditUser = Socialite::driver('reddit')->user();

    /** @var User $user */
    $user = User::updateOrCreate([
        'reddit_id' => $redditUser->getId(),
    ], [
        'name' => $redditUser->getNickname(),
        'reddit_id' => $redditUser->getId()
    ]);

    Auth::login($user);

    return view('auth.callback', [
        'sanctum' => $user->createToken('API Token')->plainTextToken,
        'reddit' => $redditUser->token
    ]);
});

Route::get('/auth/logout', function () {
    Auth::logout();

    return to_route('home');
})->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('threads', [ThreadController::class, 'index'])->name('thread.view');
    Route::get('threads/nested', [ThreadController::class, 'nested'])->name('thread.view.nested');
});
