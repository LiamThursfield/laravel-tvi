<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class InertiaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap inertia
     *
     * @return void
     */
    public function boot()
    {
        $this->setView();
        $this->versionAssets();
        $this->shareData();
    }


    /**
     * Set the root view based on whether the route is for app, auth or admin
     */
    protected function setView()
    {
        if(request()->is('admin/*')){
            Inertia::setRootView('admin');
        } elseif (request()->is(['login', 'register', 'password/*'])) {
            Inertia::setRootView('auth');
        } else {
            Inertia::setRootView('app');
        }
    }


    /**
     * Share base data with inertia, including:
     *  - App data
     *  - Auth data
     *  - Errors
     */
    protected function shareData()
    {
        Inertia::share([
            'app' => [
                'name' => Config::get('app.name')
            ],
            'auth' => function () {
                return [
                    'user' => Auth::user() ? [
                        'email'         => Auth::user()->email,
                        'first_name'    => Auth::user()->first_name,
                        'id'            => Auth::user()->id,
                        'last_name'     => Auth::user()->last_name,
                        'name'          => Auth::user()->name
                    ] : null
                ];
            },
            'errors' => function () {
                return Session::get('errors')
                    ? Session::get('errors')->getBag('default')->getMessages()
                    : (object) [];
            },
            'flash' => function () {
                return [
                    'status'    => Session::get('status'),
                    'success'   => Session::get('success'),
                ];
            },
        ]);
    }


    /**
     * Enable asset versioning
     */
    protected function versionAssets()
    {
        Inertia::version(function () {
            return md5_file(public_path('mix-manifest.json'));
        });
    }
}
