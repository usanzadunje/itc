<?php

namespace App\Providers;

use App\Actions\Fortify\AttemptToAuthenticate;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Custom bindings for Fortify classes which will switch Fortify implmentation
     * with our own.
     *
     * @var array|string[]
     */
    public array $bindings = [
        \Laravel\Fortify\Http\Requests\LoginRequest::class => \App\Http\Requests\LoginRequest::class,
        \Laravel\Fortify\Contracts\LoginResponse::class => \App\Http\Responses\LoginResponse::class,
        \Laravel\Fortify\Contracts\RegisterResponse::class => \App\Http\Responses\RegisterResponse::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Fortify::createUsersUsing(CreateNewUser::class);

        RateLimiter::for('login', function(Request $request) {
            $email = (string)$request->email;

            if(app()->environment('local')) {
                return Limit::perMinute(150)->by($email . $request->ip());
            }

            return Limit::perMinute(5)->by($email . $request->ip());
        });
    }
}
