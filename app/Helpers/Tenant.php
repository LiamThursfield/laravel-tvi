<?php

if (!function_exists('tenant_name')) {
    function get_tenant_name(): string
    {
        if (!tenant()) {
            return config('app.name');
        }

        /** @var \App\Models\Settings\ThemeSettings $theme */
        $theme = app(\App\Models\Settings\ThemeSettings::class);

        if (!$theme->site_name || !strlen($theme->site_name)) {
            return tenant()->id;
        }

        return $theme->site_name;
    }
}
