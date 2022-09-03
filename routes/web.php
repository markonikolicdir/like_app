<?php

use App\Models\User;
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
    return view('welcome');
});

Route::get('/auth/redirect', function () {
    return Socialite::driver('reddit')->redirect();
});

Route::get('/auth/callback', function () {
    $user = Socialite::driver('reddit')->user();

    /** @var User $user */
    $user = User::updateOrCreate([
        'reddit_id' => $user->getId(),
    ], [
        'name' => $user->getNickname(),
        'reddit_id' => $user->getId()
    ]);

    return $user->createToken('API Token')->plainTextToken;

    // TODO Check how to use it later in requests
});
