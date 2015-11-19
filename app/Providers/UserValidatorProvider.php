<?php

namespace App\Providers;

use App\Model\User;
use Illuminate\Support\ServiceProvider;
use Validator;

class UserValidatorProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // Validator::extend('foo', function ($attribute, $value, $parameters, $validator) {
        //     return false;
        // });
        Validator::extend('unique_mail', function ($attribute, $value, $parameters, $validator) {
            $User = new User;
            return !$User->has($value);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
