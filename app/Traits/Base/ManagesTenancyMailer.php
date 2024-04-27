<?php

namespace App\Traits\Base;

use App\Interfaces\ThirdPartyInterface;
use App\Models\Settings\ThirdPartySettings;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Stancl\Tenancy\Contracts\Tenant;

trait ManagesTenancyMailer
{
    private $mailer_key = 'tenant_mailer';

    protected function setMailConfigDefaults(): void
    {
        Config::set('mail', default_mail_config());
        Config::set('services', default_services_config());
    }

    protected function setMailConfigForTenant(Tenant $tenant, $mailerOverride = null): void
    {
        if ($mailerOverride) {
            $mailerSetting = $mailerOverride;
        } else {
            $mailerSetting = app(ThirdPartySettings::class)->mailer;

            // If no settings, use env as normal
            if (is_null($mailerSetting)) {
                return;
            }
        }

        $this->setMailFromConfigForTenant($tenant, $mailerSetting);
        $this->setDefaultMailerConfigForTenant($tenant, $mailerSetting);

        switch (Arr::get($mailerSetting, 'mailer')) {
            case ThirdPartyInterface::MAILER_MAILGUN:
                $this->setMailgunMailerForTenant($tenant, $mailerSetting);
                break;
            case ThirdPartyInterface::MAILER_SES:
                $this->setSesMailerForTenant($tenant, $mailerSetting);
                break;
            case ThirdPartyInterface::MAILER_SMTP:
                $this->setSmtpMailerForTenant($tenant, $mailerSetting);
                break;
        }
    }

    protected function setMailgunMailerForTenant(Tenant $tenant, array $mailerSetting): void
    {

        $this->setMailerConfigForTenant([
        'transport' => ThirdPartyInterface::MAILER_MAILGUN,
        ]);

        $this->setServicesConfig(
            'mailgun',
            [
                'domain' => Arr::get($mailerSetting, ThirdPartyInterface::MAILER_CONFIG_SERVICE_DOMAIN),
                'secret' => Arr::get($mailerSetting, ThirdPartyInterface::MAILER_CONFIG_SERVICE_SECRET),
                'endpoint' => Arr::get($mailerSetting, ThirdPartyInterface::MAILER_CONFIG_SERVICE_ENDPOINT) ?? 'api.mailgun.net',
            ]
        );
    }

    protected function setSesMailerForTenant(Tenant $tenant, array $mailerSetting): void
    {
        $this->setMailerConfigForTenant([
            'transport' => ThirdPartyInterface::MAILER_SES,
        ]);

        $this->setServicesConfig(
            'ses',
            [
                'key' => Arr::get($mailerSetting, ThirdPartyInterface::MAILER_CONFIG_SERVICE_KEY),
                'secret' => Arr::get($mailerSetting, ThirdPartyInterface::MAILER_CONFIG_SERVICE_SECRET),
                'region' => Arr::get($mailerSetting, ThirdPartyInterface::MAILER_CONFIG_SERVICE_REGION),
            ]
        );
    }

    protected function setSmtpMailerForTenant(Tenant $tenant, array $mailerSetting): void
    {
        $this->setMailerConfigForTenant([
            'transport' => ThirdPartyInterface::MAILER_SMTP,
            'host' => Arr::get($mailerSetting, ThirdPartyInterface::MAILER_CONFIG_HOST),
            'port' => Arr::get($mailerSetting, ThirdPartyInterface::MAILER_CONFIG_PORT),
            'encryption' => Arr::get($mailerSetting, ThirdPartyInterface::MAILER_CONFIG_ENCRYPTION),
            'username' => Arr::get($mailerSetting, ThirdPartyInterface::MAILER_CONFIG_USERNAME),
            'password' => Arr::get($mailerSetting, ThirdPartyInterface::MAILER_CONFIG_PASSWORD),
            'timeout' => is_numeric(Arr::get($mailerSetting, ThirdPartyInterface::MAILER_CONFIG_TIMEOUT)) ? Arr::get($mailerSetting, ThirdPartyInterface::MAILER_CONFIG_TIMEOUT) : null,
        ]);
    }

    protected function setDefaultMailerConfigForTenant(Tenant $tenant, array $mailerSetting): void
    {
        Config::set('mail.default', $this->mailer_key);
    }

    protected function setMailFromConfigForTenant(Tenant $tenant, array $mailerSetting): void
    {
        Config::set(
            'mail.from',
            [
                'address' => Arr::get($mailerSetting, ThirdPartyInterface::MAILER_CONFIG_FROM_ADDRESS),
                'name' => Arr::get($mailerSetting, ThirdPartyInterface::MAILER_CONFIG_FROM_NAME),
            ]
        );
    }

    protected function setMailerConfigForTenant(array $config): void
    {
        Config::set(
            'mail.mailers.' . $this->mailer_key,
            $config
        );
    }

    protected function setServicesConfig(string $service, array $config): void
    {
        Config::set(
            'services.' . $service,
            $config
        );
    }
}
