<?php

use Honeybadger\HoneybadgerLaravel\Breadcrumbs;

return [
    /**
     * Your project's Honeybadger API key. Get this from the project settings on your Honeybadger dashboard.
     */
    'api_key' => env('HONEYBADGER_API_KEY'),

    /**
     * Your personal authentication token. Get this from authentication tab in your User Settings page.
     */
    'personal_auth_token' => env('HONEYBADGER_PERSONAL_AUTH_TOKEN'),

    /**
     * The application environment.
     */
    'environment_name' => env('APP_ENV'),

    /**
     * To disable exception reporting, set this to false.
     */
    'report_data' => ! in_array(env('APP_ENV'), ['local', 'testing']),

    /**
     * When reporting an exception, we'll automatically include relevant environment variables.
     * See the Environment Whitelist (https://docs.honeybadger.io/lib/php/reference/configuration.html#environment-whitelist) for details.
     * Use this section to filter or include env variables.
     */
    'environment' => [
        /**
         * List of environment variables that should be filtered out when sending a report to Honeybadger.
         */
        'filter' => [
            // "QUERY_STRING",
        ],

        /**
         * List of environment variables that should be included when sending a report to Honeybadger.
         */
        'include' => [
            // "APP_DEBUG"
        ],
    ],

    /**
     * We include details of the request when reporting an exception. Use this section to configure this.
     */
    'request' => [
        /**
         * Fields in the request body that should be filtered out.
         * By default, we filter out any fields named similarly to "password" or "token", but you can add more.
         */
        'filter' => [
            // "credit_card_number",
        ],
    ],

    /**
     * The current version of your application. Use this to easily tie errors to specific releases or commits.
     * If you'd like to automatically use the Git commit hash as the version, set this to:
     *   'version' => trim(exec('git log --pretty="%h" -n1 HEAD')).
     */
    'version' => env('APP_VERSION'),

    /**
     * The hostname of the machine the app is running on.
     */
    'hostname' => gethostname(),

    /**
     * The root directory of your project.
     */
    'project_root' => base_path(),

    /**
     * Older PHP functions use the Error class, while modern PHP mostly uses Exception.
     * Specify if you'd like Honeybadger to report both types of errors.
     */
    'handlers' => [
        'exception' => true,
        'error' => true,
    ],

    /**
     * Customise the Guzzle client the Honeybadger SDK uses internally.
     * See https://docs.guzzlephp.org/en/stable/request-options.html for a description of each item,.
     */
    'client' => [
        'timeout' => 15,
        'proxy' => [],
        'verify' => env('HONEYBADGER_VERIFY_SSL', true),
    ],

    /**
     * Enable reporting deprecation warnings.
     */
    'capture_deprecations' => false,

    /**
     * Exception classes that should not be reported to Honeybadger.
     */
    'excluded_exceptions' => [],

    'breadcrumbs' => [
        /**
         * Enable recording of breadcrumbs (application events).
         * Setting this to false will disable automatic breadcrumbs and the addBreadcrumb() function.
         */
        'enabled' => true,

        /**
         * Events which should automatically be recorded by the Honeybadger client.
         * Note that to track redis events, you need to call `Redis::enableEvents()` in your app.
         */
        'automatic' => [
            Breadcrumbs\DatabaseQueryExecuted::class,
            Breadcrumbs\DatabaseTransactionStarted::class,
            Breadcrumbs\DatabaseTransactionCommitted::class,
            Breadcrumbs\DatabaseTransactionRolledBack::class,
            Breadcrumbs\CacheHit::class,
            Breadcrumbs\CacheMiss::class,
            Breadcrumbs\JobQueued::class,
            Breadcrumbs\MailSending::class,
            Breadcrumbs\MailSent::class,
            Breadcrumbs\MessageLogged::class,
            Breadcrumbs\NotificationSending::class,
            Breadcrumbs\NotificationSent::class,
            Breadcrumbs\NotificationFailed::class,
            Breadcrumbs\RedisCommandExecuted::class,
            Breadcrumbs\RouteMatched::class,
            Breadcrumbs\ViewRendered::class,
        ],
    ],

    /**
     * Define your checkins here and synchronize them to Honeybadger with the
     * honeybadger:checkins:sync artisan command.
     * The recommended approach is to run this command as part of your deploy process.
     * Learn more about checkins at https://docs.honeybadger.io/api/reporting-check-ins/
     */
    'checkins' =>  [],
];
