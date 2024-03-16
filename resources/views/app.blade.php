@php
    try {
        $theme = app(\App\Models\Settings\ThemeSettings::class);
    } catch (\Exception $e) {
        // Do nothing
    }
@endphp

<!DOCTYPE html>
<html class="html-base">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <title>SIGI</title>

        <link href="{{ mix('/css/app.css') }}" rel="stylesheet"/>


        @routes
        <script src="{{ mix('/js/app.js') }}" defer></script>

        @if($theme)
        <style>
            #website-layout, #course-layout {
                {{ $theme->getColorsAsCssString() }}
            }
        </style>
        @endif

        <script>
            window.locale = '{{ app()->getLocale() }}';
        </script>
        <script src="https://player.vimeo.com/api/player.js"></script>
    </head>

    <body>
        @inertia
    </body>
</html>
