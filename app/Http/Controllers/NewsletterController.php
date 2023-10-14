<?php

namespace App\Http\Controllers;

use App\Services\MailChimpNewsletter;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function __invoke(MailChimpNewsletter $newsletter)
  {
    request()->validate([
      'email' => 'required|email'
    ]);

    try {
      $newsletter->subscribe(request('email'));
    } catch (\Exception $e) {
      throw ValidationException::withMessages([
        'email' => 'This email could not be added to our newsletter.'
      ]);
    }

    return redirect('/')->with('success', 'You are now subscribed to our newsletter!');
  }
}
