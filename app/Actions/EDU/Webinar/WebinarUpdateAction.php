<?php

namespace App\Actions\EDU\Webinar;

use App\Models\EDU\Webinar\Webinar;

class WebinarUpdateAction
{
    public function handle(Webinar $webinar, array $data): ?Webinar
    {
        $webinar->update($data);

        return $webinar->fresh();
    }
}
