@php
    $theme = app(\App\Models\Settings\ThemeSettings::class);
@endphp

<!DOCTYPE html>
<html class="html-base">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <title>SIGI</title>

        <link href="@php echo mix('/css/app.css') @endphp" rel="stylesheet"/>


        @routes()
        <script src="@php echo  mix('/js/app.js') @endphp" defer></script>

        <style>
            #website-layout, #course-layout {
                @php echo $theme->getColorsAsCssString() @endphp
            }
        </style>

        <script>
            window.locale = '@php echo app()->getLocale() @endphp';
        </script>
    </head>

    <body>
        @inertia()
    </body>
</html>
