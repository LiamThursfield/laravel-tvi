<?php

namespace App\Http\Resources\Admin\Setting;

use App\Interfaces\LocaleInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class CoreSettingEditResource extends JsonResource
{
    public function toArray($request)
    {
       return [
           'locale' => [
               'value' => $this->locale,
               'type' => 'select',
               'label' => 'Locale',
               'description' => 'The global locale for the app.',
               'options' => LocaleInterface::ALL_LOCALES
           ],
       ];
    }
}
