<?php

namespace App\Actions\EDU\Webinar;

use App\Interfaces\EDU\Webinar\WebinarInterface;
use App\Models\EDU\Webinar\Webinar;
use App\Traits\Admin\Slugify;
use Illuminate\Support\Facades\Auth;

class WebinarStoreAction
{
    use Slugify;

    public function handle(array $data) : Webinar
    {
        $data['slug'] = $this->slugifyWithUnix($data['name']);
        $data['status'] = WebinarInterface::STATUS_DRAFT;
        $data['creator_id'] = Auth::id();

        return Webinar::create($data);
    }
}
