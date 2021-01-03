<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetsController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\ExploresController;
use App\Http\Controllers\TweetLikesController;
use App\Http\Controllers\addInfosController;
Use App\Http\Livewire\Explore;


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

Route::resource('/tweet', TweetsController::class)->names(['index' => 'home']);

Route::post('/tweets/{tweet}/like', [TweetLikesController::class, 'store']);
Route::delete('/tweets/{tweet}/dislike', [TweetLikesController::class, 'destroy']);


Route::get('/profiles/{user:username}/edit', [ProfilesController::class, 'edit']);
Route::get('/profiles/{user:username}', [ProfilesController::class, 'show'])->name('profile'); //we cant use the resource because we use the name of the user to SHOW the info. NOT THE ID. check User model for getRouteKeyName() because we changed it to find user by name not by id
//user:name finds the user by name not by id.
Route::put('/profiles/{user:username}', [ProfilesController::class, 'update']);

Route::post('/profiles/{user:username}/follow', [FollowsController::class, 'store']);

Route::post('/addInfo/{user:username}/add', [addInfosController::class, 'store']); //add additional info

Route::get('/explore', Explore::class);
// Route::get('/explore', [ExploresController::class, 'index']);


Auth::routes();

// Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home'); //this is no longer use, i changed it in the