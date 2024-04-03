<?php

namespace App\Models\Settings;

use App\Interfaces\ThemeInterface;
use Illuminate\Support\Arr;
use phpDocumentor\Reflection\Types\This;
use Spatie\LaravelSettings\Settings;

class ThemeSettings extends Settings
{
    public ?array $colors;

    public ?string $favicon_url;

    public ?string $logo_url;

    public ?string $site_name;


    public static function group(): string
    {
        return 'theme';
    }

    public function getLogoUrl(): ?string
    {
        return $this->logo_url;
    }

    public function getFaviconUrl(): ?string
    {
        return $this->favicon_url;
    }

    public function getSiteName(): ?string
    {
        return $this->site_name;
    }

    public function getGeneralThemeSettingsArray(): array
    {
        return [
            $this->favicon_url,
            $this->logo_url,
            $this->site_name,
        ];
    }

    public function getColorsAsCssArray(): array
    {
        $cssVars = ThemeInterface::ALL_COLORS_CSS_VARS;

        $cssArray = [];
        foreach ($cssVars as $colorKey => $cssVar) {
            if (Arr::get($this->colors, $colorKey)) {
                $cssArray['--' . $cssVar] = Arr::get($this->colors, $colorKey);
            }
        }

        return $cssArray;
    }

    public function getColorsAsCssString(): string
    {
        $cssString = '';
        foreach ($this->getColorsAsCssArray() as $cssVar => $color) {
            $cssString .= "$cssVar: $color; ";
        }

        return $cssString;
    }

}
