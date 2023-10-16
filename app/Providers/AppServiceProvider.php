<?php

namespace App\Providers;

use App\Models\User;
use App\Services\MailChimpNewsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    app()->bind(MailChimpNewsletter::class, function () {
      $client = (new ApiClient)->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => 'us21'
      ]);

      return new MailChimpNewsletter($client);
    });
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    Model::unguard();

    // authorization logic
    Gate::define('admin', function (User $user) {
      return $user->username === "dean";
    });

    // creating a blade directive
    Blade::if('admin', function() {
      return request()->user()?->can('admin');
    });
  }
}
