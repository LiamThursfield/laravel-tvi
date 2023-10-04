<?php

namespace App\Actions\EDU\Announcement;

use App\Interfaces\EDU\Course\CourseInterface;
use App\Models\EDU\Announcement\Announcement;

class AnnouncementPublishAction
{
    public function handle(Announcement $announcement)
    {
        return Announcement::where('id', $announcement->id)->update(['status'=> CourseInterface::STATUS_PUBLISHED]);
    }
}
