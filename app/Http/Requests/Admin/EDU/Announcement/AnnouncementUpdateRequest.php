<?php

namespace App\Http\Requests\Admin\EDU\Announcement;

use App\Http\Requests\BaseIndexRequest;

class AnnouncementUpdateRequest extends BaseIndexRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'creator_id' => 'sometimes|exists:users,id',
            'status' => 'nullable|string',
            'platform' => 'nullable|bool',
            'email' => 'nullable|bool',
            'sms' => 'nullable|bool',
        ]);
    }
}
