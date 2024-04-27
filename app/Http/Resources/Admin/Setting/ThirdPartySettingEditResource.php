<?php

namespace App\Http\Resources\Admin\Setting;

use App\Interfaces\ThirdPartyInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class ThirdPartySettingEditResource extends JsonResource
{
    public function toArray($request)
    {
       return [
           'stripe_publishable_key' => [
               'value' => $this->stripe_publishable_key,
               'type' => 'password',
               'label' => 'Stripe Publishable Key',
               'description' => 'The publishable key for Stripe.',
           ],
           'stripe_secret_key' => [
               'value' => $this->stripe_secret_key,
               'type' => 'password',
               'label' => 'Stripe Secret Key',
               'description' => 'The secret key for Stripe.',
           ],
           'gtm_id' => [
               'value' => $this->gtm_id,
               'type' => 'text',
               'label' => 'GTM ID',
               'description' => 'The id for Google Tag Manager. Enables GTM if set.',
           ],
           'mailer' => [
               'value' => $this->mailer,
               'type' => 'mailer',
               'label' => 'Mail Settings',
               'description' => 'The config for the mailer.',
               'mailers' => ThirdPartyInterface::ALL_MAILERS_LABELLED,
               'mailerSettingKeys' => ThirdPartyInterface::ALL_MAILER_SETTING_KEYS,
               'mailerSettingLabels' => ThirdPartyInterface::ALL_MAILER_CONFIGS_LABELLED,
               'mailerSettingTypes' => ThirdPartyInterface::ALL_MAILER_CONFIGS_TYPES,
           ],
       ];
    }
}
