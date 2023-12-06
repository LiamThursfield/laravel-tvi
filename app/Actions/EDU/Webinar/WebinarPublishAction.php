<?php

namespace App\Actions\EDU\Webinar;

use App\Interfaces\EDU\Webinar\WebinarInterface;
use App\Models\EDU\Webinar\Webinar;

class WebinarPublishAction
{
    public function handle(Webinar $webinar)
    {
        return Webinar::where('id', $webinar->id)->update(['status'=> WebinarInterface::STATUS_PUBLISHED]);
    }
}
