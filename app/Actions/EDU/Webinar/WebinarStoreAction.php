<?php

namespace App\Actions\EDU\Webinar;

use App\Models\EDU\Webinar\Webinar;
use Illuminate\Support\Str;

class WebinarStoreAction
{
    public function handle(array $data) : Webinar
    {
        $data['slug'] = Str::slug($data['title']);

        return Webinar::create($data);
    }
}
