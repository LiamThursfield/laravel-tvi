<?php

namespace App\Actions\EDU\Announcement;

use App\Models\EDU\Announcement\Announcement;

class AnnouncementUpdateAction
{
    public function handle(Announcement $announcement, array $data): ?Announcement
    {
        $announcement->update($data);

        return $announcement->fresh();
    }
}
