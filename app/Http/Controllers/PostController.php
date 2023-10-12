<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
  public function index()
  {
    return view('posts.index', [
      'posts' => Post::latest()
        ->filter(request(['search', 'category', 'author']))
        ->paginate(6)->withQueryString()
      // 'categories' => Category::all(),
      // 'currentCategory' => Category::firstWhere('slug', request('category'))
    ]);
  }

  public function show(Post $post)
  {
    return view('posts.show', [
      'post' => $post,
      // 'comments' => []
      // 'categories' => Category::all()
    ]);
  }
}
