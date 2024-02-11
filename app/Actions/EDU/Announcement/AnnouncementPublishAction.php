<?php

namespace App\Actions\EDU\Announcement;

use App\Interfaces\EDU\Announcement\AnnouncementInterface;
use App\Models\EDU\Announcement\Announcement;

class AnnouncementPublishAction
{
    public function handle(Announcement $announcement)
    {
        $announcement->update(['status' => AnnouncementInterface::STATUS_PUBLISHED]);

        return $announcement->fresh();
    }
}
