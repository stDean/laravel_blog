<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
  public function create()
  {
    return view('session.create');
  }

  public function store(Request $request)
  {
    $attributes = $request->validate([
      'email' => ["required", "email", Rule::exists('users', 'email')],
      'password' => "required"
    ]);

    if (!auth()->attempt($attributes)) {
      // return back()
      //   ->withErrors(['email' => 'Your provided credential can not be verified.'])
      //   ->onlyInput('email')
      throw ValidationException::withMessages([
        'email' => 'Your provided credential can not be verified.'
      ]);
    }

    $request->session()->regenerate();
    return redirect('/')->with('success', "Welcome Back!");;
  }

  public function destroy(Request $request)
  {
    auth()->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('success', "Goodbye");
  }
}
