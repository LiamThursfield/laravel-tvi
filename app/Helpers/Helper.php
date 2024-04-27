<?php

/**
 * This should be used instead of adding config options directly to config/mail.php
 * As it allows for defaults to be loaded reloaded if needed
 */
if (! function_exists('default_mail_config')) {
    function default_mail_config(): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Default Mailer
            |--------------------------------------------------------------------------
            |
            | This option controls the default mailer that is used to send any email
            | messages sent by your application. Alternative mailers may be setup
            | and used as needed; however, this mailer will be used by default.
            |
            */

            'default' => env('MAIL_MAILER', 'smtp'),

            /*
            |--------------------------------------------------------------------------
            | Mailer Configurations
            |--------------------------------------------------------------------------
            |
            | Here you may configure all of the mailers used by your application plus
            | their respective settings. Several examples have been configured for
            | you and you are free to add your own as your application requires.
            |
            | Laravel supports a variety of mail "transport" drivers to be used while
            | sending an e-mail. You will specify which one you are using for your
            | mailers below. You are free to add additional mailers as required.
            |
            | Supported: "smtp", "sendmail", "mailgun", "ses",
            |            "postmark", "log", "array"
            |
            */

            'mailers' => [
                'smtp' => [
                    'transport' => 'smtp',
                    'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
                    'port' => env('MAIL_PORT', 587),
                    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
                    'username' => env('MAIL_USERNAME'),
                    'password' => env('MAIL_PASSWORD'),
                    'timeout' => null,
                ],

                'ses' => [
                    'transport' => 'ses',
                ],

                'mailgun' => [
                    'transport' => 'mailgun',
                ],

                'postmark' => [
                    'transport' => 'postmark',
                ],

                'sendmail' => [
                    'transport' => 'sendmail',
                    'path' => '/usr/sbin/sendmail -bs',
                ],

                'log' => [
                    'transport' => 'log',
                    'channel' => env('MAIL_LOG_CHANNEL'),
                ],

                'array' => [
                    'transport' => 'array',
                ],
            ],

            /*
            |--------------------------------------------------------------------------
            | Global "From" Address
            |--------------------------------------------------------------------------
            |
            | You may wish for all e-mails sent by your application to be sent from
            | the same address. Here, you may specify a name and address that is
            | used globally for all e-mails that are sent by your application.
            |
            */

            'from' => [
                'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
                'name' => env('MAIL_FROM_NAME', 'Example'),
            ],

            /*
            |--------------------------------------------------------------------------
            | Markdown Mail Settings
            |--------------------------------------------------------------------------
            |
            | If you are using Markdown based email rendering, you may configure your
            | theme and component paths here, allowing you to customize the design
            | of the emails. Or, you may simply stick with the Laravel defaults!
            |
            */

            'markdown' => [
                'theme' => 'default',

                'paths' => [
                    resource_path('views/vendor/mail'),
                ],
            ],

        ];
    }
}

/**
 * This should be used instead of adding config options directly to config/mail.php
 * As it allows for defaults to be loaded reloaded if needed
 */
if (! function_exists('default_services_config')) {
    function default_services_config(): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Third Party Services
            |--------------------------------------------------------------------------
            |
            | This file is for storing the credentials for third party services such
            | as Mailgun, Postmark, AWS and more. This file provides the de facto
            | location for this type of information, allowing packages to have
            | a conventional file to locate the various service credentials.
            |
            */
            'mailgun' => [
                'domain' => env('MAILGUN_DOMAIN'),
                'secret' => env('MAILGUN_SECRET'),
                'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
            ],

            'postmark' => [
                'token' => env('POSTMARK_TOKEN'),
            ],

            'ses' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
                'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            ],
        ];
    }
}
