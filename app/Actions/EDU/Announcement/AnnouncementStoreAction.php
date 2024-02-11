<?php

namespace App\Actions\EDU\Announcement;

use App\Models\EDU\Announcement\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AnnouncementStoreAction
{
    public function handle(array $data) : Announcement
    {
        $data['slug'] = Str::slug($data['title']);
        $data['creator_id'] = Auth::id();

        return Announcement::create($data);
    }
}
