<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->inertiaSetup();
    }

    protected function inertiaSetup()
    {
        // Set the root view based on whether the route is for app or admin
        if(request()->is('admin/*')){
            Inertia::setRootView('admin');
        } elseif (request()->is(['login', 'register', 'password/*'])) {
            Inertia::setRootView('auth');
        } else {
            Inertia::setRootView('app');
        }

        // Enable asset versioning
        Inertia::version(function () {
            return md5_file(public_path('mix-manifest.json'));
        });

        // Shared data
        Inertia::share([
            'app' => [
                'name' => Config::get('app.name')
            ],
            'auth' => function () {
                return [
                    'user' => Auth::user() ? [
                        'email' => Auth::user()->email,
                        'id'    => Auth::user()->id,
                        'name'  => Auth::user()->name
                    ] : null
                ];
            },
            'errors' => function () {
                return Session::get('errors')
                    ? Session::get('errors')->getBag('default')->getMessages()
                    : (object) [];
            },
        ]);
    }
}
