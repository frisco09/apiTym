<?php

namespace App\Providers;

use App\Mail\userCreated;
use App\Mail\userMailChanged;
use App\User;
use Illuminate\Database\Schema\defaultStringLength;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        User::created(function($user) {
            retry(5, function() use ($user) {
                Mail::to($user)->send(new userCreated($user));
            }, 100);
        });
        
        User::updated(function($user) {
            if ($user->isDirty('email')) {
                retry(5, function() use ($user) {
                    Mail::to($user)->send(new userMailChanged($user));
                }, 100);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
