<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCommentController extends Controller
{
  public function store(Post $post, Request $request)
  {
    $request->validate([
      'body' => 'required'
    ]);

    $post->comments()->create([
      'body' => $request->input('body'),
      'user_id' => Auth::id()
    ]);

    return back();
  }
}
