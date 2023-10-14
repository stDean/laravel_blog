<?php

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', [PostController::class, 'index'])->name('home');

// Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('post');

// Group routes!!
Route::controller(PostController::class)->group(function () {
  Route::get('/', 'index')->name('home');
  Route::get('posts/{post:slug}', 'show')->name('post');
  Route::get('admin/posts/create', 'create')->middleware('admin');
  Route::post('admin/posts', 'store')->middleware('admin');
});

Route::post('posts/{post:slug}/comment', [PostCommentController::class, 'store']);

Route::controller(RegisterController::class)
  ->middleware('guest')
  ->group(function () {
    Route::get('register', 'create');
    Route::post('register', 'store');
  });

Route::get('login', [SessionController::class, 'create'])->middleware('guest');
Route::post('session', [SessionController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');

// Route::get('category/{category:slug}', function (Category $category) {
//   return view('posts', [
//     'posts' => $category->posts,
//     'categories' => Category::all(),
//     'currentCategory' => $category
//   ]);
// })->name('category');

// Route::get('authors/{author:username}', function (User $author) {
//   return view('posts.index', [
//     'posts' => $author->posts,
// 'categories' => Category::all()
//   ]);
// })->name('author');

Route::post('newsletter', NewsletterController::class);
