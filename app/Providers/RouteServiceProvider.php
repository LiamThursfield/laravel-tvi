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
        $this->mapLandlordAdminRoutes();
        $this->mapLandlordAdminApiRoutes();

        // Tenant routes
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapAdminRoutes();
        $this->mapAdminApiRoutes();
        $this->mapStudentWebRoutes();
        $this->mapStudentAdminRoutes();
        $this->mapWebhookRoutes();
    }

    protected function mapAdminRoutes(): void
    {
        Route::middleware(['admin','tenant'])
            ->namespace($this->namespace)
            ->as('admin.')
            ->prefix('admin')
            ->group(base_path('routes/admin.php'));
    }

    protected function mapAdminApiRoutes(): void
    {
        Route::middleware(['admin','tenant'])
            ->namespace($this->namespace)
            ->as('admin.api.')
            ->prefix('admin/api')
            ->group(base_path('routes/admin-api.php'));
    }

    protected function mapApiRoutes(): void
    {
        Route::middleware(['api', 'tenant'])
            ->namespace($this->namespace)
            ->as('api.')
            ->prefix('api')
            ->group(base_path('routes/api.php'));
    }

    protected function mapWebRoutes(): void
    {
        Route::middleware(['web', 'tenant'])
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    protected function mapStudentWebRoutes(): void
    {
        Route::middleware(['web', 'tenant'])
            ->namespace($this->namespace)
            ->as('student.')
            ->prefix('student')
            ->group(base_path('routes/student-web.php'));
    }

    protected function mapStudentAdminRoutes(): void
    {
        Route::middleware(['student-admin','tenant'])
            ->namespace($this->namespace)
            ->as('student.admin.')
            ->prefix('student')
            ->group(base_path('routes/student-admin.php'));
    }

    protected function mapWebhookRoutes(): void
    {
        Route::middleware(['webhook', 'tenant'])
            ->namespace($this->namespace)
            ->as('webhook.')
            ->prefix('webhook')
            ->group(base_path('routes/webhook.php'));
    }

    protected function mapLandlordWebRoutes(): void
    {
        $this->buildLandlordRoutes(
            ['landlord-web', 'landlord.set-guard'],
            'landlord',
            'routes/landlord/web.php'
        );
    }

    protected function mapLandlordAdminRoutes(): void
    {
        $this->buildLandlordRoutes(
            ['landlord-admin'],
            'landlord.admin',
            'routes/landlord/admin.php',
            'admin'
        );
    }

    protected function mapLandlordAdminApiRoutes(): void
    {
        $this->buildLandlordRoutes(
            ['landlord-admin'],
            'landlord.admin.api',
            'routes/landlord/admin-api.php',
            'admin/api'
        );
    }

    protected function centralDomains(): array
    {
        return config('tenancy.central_domains');
    }

    protected function buildLandlordRoutes(string|array $middleware, string $as, string $path, string $prefix = ''): void
    {
        $domainCount = 0;
        foreach ($this->centralDomains() as $domain) {
            // Add the domain count to the route name if there is more than one central domain
            // Otherwise we cannot cache routes

            $computedAs = ($domainCount > 0) ? $as . '.' . $domainCount . '.' : $as . '.';
            $domainCount++;

            Route::middleware($middleware)
                ->namespace($this->namespace)
                ->domain($domain)
                ->as($computedAs)
                ->prefix($prefix)
                ->group(base_path($path));
        }
    }
}
