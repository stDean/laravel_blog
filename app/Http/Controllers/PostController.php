<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

  public function create()
  {
    return view('posts.create');
  }

  public function store(Request $request)
  {
    $attributes = $request->validate([
      'title' => 'required',
      'slug' => ['required', Rule::unique('posts', 'slug')],
      'thumbnail' => 'image',
      'excerpt' => 'required',
      'body' => 'required',
      'category_id' => ['required', Rule::exists('categories', 'id')],
    ]);

    $attributes['user_id'] = auth()->id();
    $attributes['thumbnail'] = $request->file('thumbnail')->store('thumbnail');

    Post::create($attributes);
    return redirect('/');
  }
}
