<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = null;

    /**
     * The path to the core "admin" route for your application.
     *
     * @var string
     */
    public const ADMIN = '/admin';

    /**
     * The path to the student "admin" route for your application.
     *
     * @var string
     */
    public const ADMIN_STUDENT = '/student';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        // Landlord routes
        $this->mapLandlordWebRoutes();


        // Tenant routes
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAdminRoutes();
        $this->mapAdminApiRoutes();

        $this->mapStudentWebRoutes();
        $this->mapStudentAdminRoutes();

        $this->mapWebhookRoutes();
    }


    protected function mapLandlordWebRoutes()
    {
        foreach ($this->centralDomains() as $domain) {
            Route::middleware('web')
                ->domain($domain)
                ->namespace($this->namespace)
                ->group(base_path('routes/landlord/web.php'));
        }
    }


    /**
     * Define the "admin" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     * They also require authentication
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::middleware(['admin','tenant'])
            ->namespace($this->namespace)
            ->as('admin.')
            ->prefix('admin')
            ->group(base_path('routes/admin.php'));
    }

    /**
     * Define the "admin api" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     * They also require authentication
     *
     * @return void
     */
    protected function mapAdminApiRoutes()
    {
        Route::middleware(['admin','tenant'])
            ->namespace($this->namespace)
            ->as('admin.api.')
            ->prefix('admin/api')
            ->group(base_path('routes/admin-api.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::middleware(['api', 'tenant'])
            ->namespace($this->namespace)
            ->as('api.')
            ->prefix('api')
            ->group(base_path('routes/api.php'));
    }

    /**
     * Define the tenant's "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware(['web', 'tenant'])
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the tenant's "student web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapStudentWebRoutes()
    {
        Route::middleware(['web', 'tenant'])
            ->namespace($this->namespace)
            ->as('student.')
            ->prefix('student')
            ->group(base_path('routes/student-web.php'));
    }

    protected function mapStudentAdminRoutes()
    {
        Route::middleware(['admin','tenant'])
            ->namespace($this->namespace)
            ->as('student.admin.')
            ->prefix('student')
            ->group(base_path('routes/student-admin.php'));
    }

    /**
     * Define the "webhook" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapWebhookRoutes()
    {
        Route::middleware(['webhook', 'tenant'])
            ->namespace($this->namespace)
            ->as('webhook.')
            ->prefix('webhook')
            ->group(base_path('routes/webhook.php'));
    }

    protected function centralDomains(): array
    {
        return config('tenancy.central_domains');
    }
}
