<?php

#use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CommentController;

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

Route::post('register', [UserController::class, 'register'])->name('register');
#original Route::post('login', [UserController::class, 'login']); 
#Route::get('login', [UserController::class, 'login'])->name('login');
Route::match(['get', 'post'], 'login', [UserController::class, 'login'])->name('login');
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:api');

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();*/

Route::middleware('auth:api')->group(function () {
Route::get('users', [UserController::class, 'getUsers'])->name('getUsers');
Route::get('users/{id}', [UserController::class, 'getUser']);
    
Route::get('blog-posts', [BlogPostController::class, 'index']);
Route::get('blog-posts/{id}', [BlogPostController::class, 'show']);
Route::post('blog-posts', [BlogPostController::class, 'store']);
Route::put('blog-posts/{id}', [BlogPostController::class, 'update']);
Route::delete('blog-posts/{id}', [BlogPostController::class, 'destroy']);
 
Route::get('comments', [CommentController::class, 'index']);
Route::get('comments/{id}', [CommentController::class, 'show']);
Route::post('comments', [CommentController::class, 'store']);
Route::put('comments/{id}', [CommentController::class, 'update']);
Route::delete('comments/{id}', [CommentController::class, 'destroy']);
});
