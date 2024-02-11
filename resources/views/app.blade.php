<!DOCTYPE html>
<html class="html-base">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <title>SIGI</title>

        <link href="{{ mix('/css/app.css') }}" rel="stylesheet"/>

        @routes
        <script src="{{ mix('/js/app.js') }}" defer></script>

        <script>
            window.locale = '{{ app()->getLocale() }}';
        </script>
    </head>

    <body>
        @inertia
    </body>
</html>
