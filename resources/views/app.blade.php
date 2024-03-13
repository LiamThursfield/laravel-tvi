<!DOCTYPE html>
<html class="html-base">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <title>SIGI</title>

        <link href="@php echo mix('/css/app.css') @endphp" rel="stylesheet"/>


        @routes
        <script src="@php mix('/js/app.js') @endphp" defer></script>

        @php
            $theme = app(\App\Models\Settings\ThemeSettings::class);
            dd($theme);
        @endphp


        <style>
            #website-layout, #course-layout {
                {{ $theme->getColorsAsCssString() }}
            }
        </style>

        <script>
            window.locale = '{{ app()->getLocale() }}';
        </script>
    </head>

    <body>
        @inertia
    </body>
</html>
