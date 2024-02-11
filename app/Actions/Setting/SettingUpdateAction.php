<?php

namespace App\Actions\Setting;

use App\Models\Settings\CoreSettings;
use App\Models\Settings\EduSettings;
use App\Models\Settings\ThirdPartySettings;
use Exception;

class SettingUpdateAction
{
    public function handle(string $group, array $settings_data)
    {
        $settings = app($this->getSettingClass($group));

        foreach ($settings_data as $key => $value) {
            $settings->{$key} = $value;
        }

        $settings->save();
    }

    protected function getSettingClass(string $group): string
    {
        switch ($group) {
            case 'core':
                return CoreSettings::class;
            case 'edu':
                return EduSettings::class;
            case 'third-party':
                return ThirdPartySettings::class;
            default:
                throw new Exception('Invalid setting group');
        }
    }
}
