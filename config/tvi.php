<?php

return [
    'pagination' => [
        'links_on_each_side' => env('TVI_PAGINATION_LINKS_ON_EACH_SIDE', 1),
    ],

    'web' => [
        // If web is disabled, users will always be redirected to admin when trying to access the home page
        'enabled' => env('TVI_WEB_ENABLED', false)
    ],
];
