<!DOCTYPE html>
<html class="html-base">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <title>SIGI</title>

        <link href="{{ mix('/css/landlord/app.css') }}" rel="stylesheet"></link>
        <link href="https://cdn.jsdelivr.net/npm/keen-slider@6.8.6/keen-slider.min.css" rel="stylesheet" />


        @routes
        <script src="{{ mix('/js/landlord/app.js') }}" defer></script>
    </head>

    <body>
        @inertia
    </body>
</html>
