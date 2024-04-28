<?php

namespace App\Interfaces;

class ThemeInterface {
    const COLOR_BASE = 'COLOR_BASE';
    const COLOR_BASE_CONTRAST = 'COLOR_BASE_CONTRAST';
    const COLOR_BASE_SUBTLE = 'COLOR_BASE_SUBTLE';
    const COLOR_BASE_SUBTLE_CONTRAST = 'COLOR_BASE_SUBTLE_CONTRAST';
    const COLOR_PRIMARY = 'COLOR_PRIMARY';
    const COLOR_PRIMARY_CONTRAST = 'COLOR_PRIMARY_CONTRAST';
    const COLOR_PRIMARY_HOVER = 'COLOR_PRIMARY_HOVER';
    const COLOR_PRIMARY_HOVER_CONTRAST = 'COLOR_PRIMARY_HOVER_CONTRAST';
    const COLOR_SECONDARY = 'COLOR_SECONDARY';
    const COLOR_SECONDARY_CONTRAST = 'COLOR_SECONDARY_CONTRAST';
    const COLOR_SECONDARY_HOVER = 'COLOR_SECONDARY_HOVER';
    const COLOR_SECONDARY_HOVER_CONTRAST = 'COLOR_SECONDARY_HOVER_CONTRAST';
    const COLOR_ACCENT = 'COLOR_ACCENT';
    const COLOR_ACCENT_CONTRAST = 'COLOR_ACCENT_CONTRAST';
    const COLOR_ACCENT_HOVER = 'COLOR_ACCENT_HOVER';
    const COLOR_ACCENT_HOVER_CONTRAST = 'COLOR_ACCENT_HOVER_CONTRAST';

    const ALL_COLORS = [
        self::COLOR_BASE                        => 'Base',
        self::COLOR_BASE_CONTRAST               => 'Base - Contrast',
        self::COLOR_BASE_SUBTLE                 => 'Base Subtle',
        self::COLOR_BASE_SUBTLE_CONTRAST        => 'Base Subtle - Contrast',
        self::COLOR_PRIMARY                     => 'Primary',
        self::COLOR_PRIMARY_CONTRAST            => 'Primary - Contrast',
        self::COLOR_PRIMARY_HOVER               => 'Primary Hover',
        self::COLOR_PRIMARY_HOVER_CONTRAST      => 'Primary Hover - Contrast',
        self::COLOR_SECONDARY                   => 'Secondary',
        self::COLOR_SECONDARY_CONTRAST          => 'Secondary - Contrast',
        self::COLOR_SECONDARY_HOVER             => 'Secondary Hover',
        self::COLOR_SECONDARY_HOVER_CONTRAST    => 'Secondary: Hover - Contrast',
        self::COLOR_ACCENT                      => 'Accent',
        self::COLOR_ACCENT_CONTRAST             => 'Accent - Contrast',
        self::COLOR_ACCENT_HOVER                => 'Accent Hover',
        self::COLOR_ACCENT_HOVER_CONTRAST       => 'Accent Hover - Contrast',
    ];

    const ALL_COLORS_CSS_VARS = [
        self::COLOR_BASE                        => 'color-base',
        self::COLOR_BASE_CONTRAST               => 'color-base-contrast',
        self::COLOR_BASE_SUBTLE                 => 'color-base-subtle',
        self::COLOR_BASE_SUBTLE_CONTRAST        => 'color-base-subtle-contrast',
        self::COLOR_PRIMARY                     => 'color-primary',
        self::COLOR_PRIMARY_CONTRAST            => 'color-primary-contrast',
        self::COLOR_PRIMARY_HOVER               => 'color-primary-hover',
        self::COLOR_PRIMARY_HOVER_CONTRAST      => 'color-primary-hover-contrast',
        self::COLOR_SECONDARY                   => 'color-secondary',
        self::COLOR_SECONDARY_CONTRAST          => 'color-secondary-contrast',
        self::COLOR_SECONDARY_HOVER             => 'color-secondary-hover',
        self::COLOR_SECONDARY_HOVER_CONTRAST    => 'color-secondary-hover-contrast',
        self::COLOR_ACCENT                      => 'color-accent',
        self::COLOR_ACCENT_CONTRAST             => 'color-accent-contrast',
        self::COLOR_ACCENT_HOVER                => 'color-accent-hover',
        self::COLOR_ACCENT_HOVER_CONTRAST       => 'color-accent-hover-contrast',
    ];

    const DEFAULT_COLORS = [
        self::COLOR_BASE                        => '#FFFFFF',
        self::COLOR_BASE_CONTRAST               => '#262C43',
        self::COLOR_BASE_SUBTLE                 => '#E2E8F0',
        self::COLOR_BASE_SUBTLE_CONTRAST        => '#262C43',
        self::COLOR_PRIMARY                     => '#2563EB',
        self::COLOR_PRIMARY_CONTRAST            => '#FFFFFF',
        self::COLOR_PRIMARY_HOVER               => '#1E40AF',
        self::COLOR_PRIMARY_HOVER_CONTRAST      => '#FFFFFF',
        self::COLOR_SECONDARY                   => '#323954',
        self::COLOR_SECONDARY_CONTRAST          => '#FFFFFF',
        self::COLOR_SECONDARY_HOVER             => '#262C43',
        self::COLOR_SECONDARY_HOVER_CONTRAST    => '#FFFFFF',
        self::COLOR_ACCENT                      => '#EA580C',
        self::COLOR_ACCENT_CONTRAST             => '#FFFFFF',
        self::COLOR_ACCENT_HOVER                => '#9A3412',
        self::COLOR_ACCENT_HOVER_CONTRAST       => '#FFFFFF',
    ];
}
