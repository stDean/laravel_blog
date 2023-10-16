<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
  public function create()
  {
    return view('register.create');
  }

  public function store(Request $request)
  {
    $attributes = $request->validate([
      'name' => ["required", "max:255"],
      'username' => "required|max:255|min:4|unique:users,username",
      'email' => ["required", "email", "max:255", Rule::unique('users', 'email')],
      'password' => "required | min:6"
    ]);
    
    $user = User::create($attributes);
    // session()->flash('success', "Your account has been created!");
    auth()->login($user);

    return redirect('/')->with('success', "Your account has been created!");
  }
}
