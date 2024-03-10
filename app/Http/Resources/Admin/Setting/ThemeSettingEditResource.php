<?php

namespace App\Http\Resources\Admin\Setting;

use App\Interfaces\ThemeInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class ThemeSettingEditResource extends JsonResource
{
    public function toArray($request)
    {
       return [
           'site_name' => [
               'value' => $this->site_name,
               'type' => 'text',
               'label' => 'Site Name',
               'description' => 'The site name, typically shown in titles etc.',
           ],
           'logo_url' => [
               'value' => $this->logo_url,
               'type' => 'text', // TODO: File type to use file manager
               'label' => 'Logo URL',
               'description' => 'The URL for the logo.',
           ],
           'favicon_url' => [
               'value' => $this->favicon_url,
               'type' => 'text', // TODO: File type to use file manager
               'label' => 'Favicon URL',
               'description' => 'The URL for the favicon.',
           ],
           'colors' => [
               'value' => $this->colors,
               'type' => 'colors',
               'label' => 'Colors',
               'description' => 'Allows all colors to be overwritten',
               'colors' => ThemeInterface::ALL_COLORS,
               'defaultColors' => ThemeInterface::DEFAULT_COLORS,
           ],
       ];
    }
}
