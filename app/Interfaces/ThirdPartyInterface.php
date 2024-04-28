<?php
namespace App\Interfaces;

use Illuminate\Support\Arr;

class ThirdPartyInterface
{
    const MAILER_MAILGUN = "mailgun";
    const MAILER_SES = "ses";
    const MAILER_SMTP = "smtp";

    const ALL_MAILERS_LABELLED = [
        self::MAILER_MAILGUN => 'Mailgun',
        self::MAILER_SES => 'Amazon SES',
        self::MAILER_SMTP => 'SMTP',
    ];

    const MAILER_CONFIG_ENCRYPTION = 'encryption';
    const MAILER_CONFIG_FROM_ADDRESS = 'from_address';
    const MAILER_CONFIG_FROM_NAME = 'from_name';
    const MAILER_CONFIG_HOST = 'host';
    const MAILER_CONFIG_USERNAME = 'username';
    const MAILER_CONFIG_PASSWORD = 'password';
    const MAILER_CONFIG_PORT = 'port';
    const MAILER_CONFIG_SERVICE_DOMAIN = 'service_domain';
    const MAILER_CONFIG_SERVICE_ENDPOINT = 'service_endpoint';
    const MAILER_CONFIG_SERVICE_KEY = 'service_key';
    const MAILER_CONFIG_SERVICE_REGION = 'service_region';
    const MAILER_CONFIG_SERVICE_SECRET = 'service_secret';
    const MAILER_CONFIG_TIMEOUT = 'timeout';

    const ALL_MAILER_CONFIGS_LABELLED = [
        self::MAILER_CONFIG_ENCRYPTION => 'Encryption',
        self::MAILER_CONFIG_FROM_ADDRESS => 'From Address',
        self::MAILER_CONFIG_FROM_NAME => 'From Name',
        self::MAILER_CONFIG_HOST => 'Host',
        self::MAILER_CONFIG_USERNAME => 'Username',
        self::MAILER_CONFIG_PASSWORD => 'Password',
        self::MAILER_CONFIG_PORT => 'Port',
        self::MAILER_CONFIG_SERVICE_DOMAIN => 'Domain',
        self::MAILER_CONFIG_SERVICE_ENDPOINT => 'Endpoint',
        self::MAILER_CONFIG_SERVICE_KEY => 'Key',
        self::MAILER_CONFIG_SERVICE_REGION => 'Region',
        self::MAILER_CONFIG_SERVICE_SECRET => 'Secret',
        self::MAILER_CONFIG_TIMEOUT => 'Timout',
    ];

    const ALL_MAILER_CONFIGS_TYPES = [
        self::MAILER_CONFIG_ENCRYPTION => 'text',
        self::MAILER_CONFIG_FROM_ADDRESS => 'text',
        self::MAILER_CONFIG_FROM_NAME => 'text',
        self::MAILER_CONFIG_HOST => 'text',
        self::MAILER_CONFIG_USERNAME => 'text',
        self::MAILER_CONFIG_PASSWORD => 'password',
        self::MAILER_CONFIG_PORT => 'number',
        self::MAILER_CONFIG_SERVICE_DOMAIN => 'text',
        self::MAILER_CONFIG_SERVICE_ENDPOINT => 'text',
        self::MAILER_CONFIG_SERVICE_KEY => 'password',
        self::MAILER_CONFIG_SERVICE_REGION => 'text',
        self::MAILER_CONFIG_SERVICE_SECRET => 'password',
        self::MAILER_CONFIG_TIMEOUT => 'number',
    ];

    const MAILER_SETTING_KEYS_MAILGUN = [
        self::MAILER_CONFIG_FROM_ADDRESS,
        self::MAILER_CONFIG_FROM_NAME,
        self::MAILER_CONFIG_SERVICE_DOMAIN,
        self::MAILER_CONFIG_SERVICE_SECRET,
        self::MAILER_CONFIG_SERVICE_ENDPOINT,
    ];

    const MAILER_SETTING_KEYS_SES = [
        self::MAILER_CONFIG_FROM_ADDRESS,
        self::MAILER_CONFIG_FROM_NAME,
        self::MAILER_CONFIG_SERVICE_KEY,
        self::MAILER_CONFIG_SERVICE_SECRET,
        self::MAILER_CONFIG_SERVICE_REGION,
    ];

    const MAILER_SETTING_KEYS_SMTP = [
        self::MAILER_CONFIG_FROM_ADDRESS,
        self::MAILER_CONFIG_FROM_NAME,
        self::MAILER_CONFIG_HOST,
        self::MAILER_CONFIG_PORT,
        self::MAILER_CONFIG_ENCRYPTION,
        self::MAILER_CONFIG_USERNAME,
        self::MAILER_CONFIG_PASSWORD,
        self::MAILER_CONFIG_TIMEOUT,
        self::MAILER_CONFIG_SERVICE_DOMAIN,
        self::MAILER_CONFIG_SERVICE_SECRET,
        self::MAILER_CONFIG_SERVICE_ENDPOINT,
    ];

    const ALL_MAILER_SETTING_KEYS = [
        self::MAILER_MAILGUN => self::MAILER_SETTING_KEYS_MAILGUN,
        self::MAILER_SES => self::MAILER_SETTING_KEYS_SES,
        self::MAILER_SMTP => self::MAILER_SETTING_KEYS_SMTP,
    ];
}
