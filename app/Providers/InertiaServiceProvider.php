<?php

namespace App\Providers;

use App\Interfaces\RoleInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\UrlWindow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
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
        $this->registerLengthAwarePaginator();
    }

    protected function registerLengthAwarePaginator()
    {
        $this->app->bind(LengthAwarePaginator::class, function ($app, $values) {
            return new class(...array_values($values)) extends LengthAwarePaginator {
                public function only(...$attributes)
                {
                    return $this->transform(function ($item) use ($attributes) {
                        return $item->only($attributes);
                    });
                }

                public function transform($callback)
                {
                    $this->items->transform($callback);

                    return $this;
                }

                public function toArray()
                {
                    return [
                        'data' => $this->items->toArray(),
                        'pagination' => [
                            'current_page'  => $this->currentPage(),
                            'last_page'     => $this->lastPage(),
                            'links'         => $this->links(),
                            'per_page'      => $this->perPage(),
                            'total'         => $this->total(),
                        ]
                    ];
                }

                public function links($view = null, $data = [])
                {
                    $this->onEachSide(\config('tvi.pagination.links_on_each_side', 1));
                    $this->appends(Request::all());

                    $window = UrlWindow::make($this);

                    $elements = array_filter([
                        $window['first'],
                        is_array($window['slider']) ? '...' : null,
                        $window['slider'],
                        is_array($window['last']) ? '...' : null,
                        $window['last'],
                    ]);

                    return Collection::make($elements)->flatMap(function ($item) {
                        if (is_array($item)) {
                            return Collection::make($item)->map(function ($url, $page) {
                                return [
                                    'url' => $url,
                                    'label' => $page,
                                    'active' => $this->currentPage() === $page,
                                ];
                            });
                        } else {
                            return [
                                [
                                    'url' => null,
                                    'label' => '...',
                                    'active' => false,
                                ],
                            ];
                        }
                    })->prepend([
                        'url' => $this->previousPageUrl(),
                        'label' => 'Previous',
                        'active' => false,
                    ])->push([
                        'url' => $this->nextPageUrl(),
                        'label' => 'Next',
                        'active' => false,
                    ])->prepend([
                        'url' => $this->currentPage() === 1 ? null : $this->url(1),
                        'label' => 'First',
                        'active' => false,
                    ])->push([
                        'url' => $this->currentPage() === $this->lastPage() ? null : $this->url($this->lastPage()),
                        'label' => 'Last',
                        'active' => false,
                    ]);
                }
            };
        });
    }


    /**
     * Set the root view
     */
    protected function setView()
    {
        Inertia::setRootView('app');
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
                'name' => Config::get('app.name'),
                'config' => [
                    'file_manager_uploads_enabled' => Config::get('tvi.file_manager.uploads.enabled', false),
                ],
            ],
            'auth' => function () {
                return [
                    'user' => Auth::user() ? [
                        'email'         => Auth::user()->email,
                        'first_name'    => Auth::user()->first_name,
                        'id'            => Auth::user()->id,
                        'last_name'     => Auth::user()->last_name,
                        'name'          => Auth::user()->name,
                        'permissions'   => Auth::user()->all_permissions,
                        'super'         => Auth::user()->hasRole(RoleInterface::SUPER),
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
                    'error'     => Session::get('error'),
                    'status'    => Session::get('status'), // @deprecated - ise the error, success, warning, etc.
                    'success'   => Session::get('success'),
                    'warning'   => Session::get('warning'),
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
