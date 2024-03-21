

<!DOCTYPE html>
<html class="html-base">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <title>SIGI</title>

        @routes
        @vite('resources/js/app.js')

        @if(tenant())
            @include('partials.tenant-head')
        @endif

        <script>
            window.locale = '{{ app()->getLocale() }}';
        </script>
    </head>

    <body class="html-base">
        @inertia
    </body>
</html>
