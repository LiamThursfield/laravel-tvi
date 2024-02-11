<?php

namespace App\Http\Requests\Admin\EDU\Announcement;

use App\Http\Requests\BaseIndexRequest;

class AnnouncementIndexRequest extends BaseIndexRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'announcement_title' => 'nullable|string',
            'announcement_slug' => 'nullable|string',
        ]);
    }
}
