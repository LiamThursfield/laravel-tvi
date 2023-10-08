<?php

namespace App\Http\Resources\Admin\Setting;

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
       ];
    }
}
