<?php

namespace App\Actions\EDU\Announcement;

use App\Models\EDU\Announcement\Announcement;
use Illuminate\Support\Str;

class AnnouncementStoreAction
{
    public function handle(array $data) : Announcement
    {
        $data['slug'] = Str::slug($data['title']);

        return Announcement::create($data);
    }
}
