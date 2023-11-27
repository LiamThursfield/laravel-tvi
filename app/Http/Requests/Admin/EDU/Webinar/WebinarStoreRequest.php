<?php

namespace App\Http\Requests\Admin\EDU\Webinar;

use App\Http\Requests\BaseIndexRequest;

class WebinarStoreRequest extends BaseIndexRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'name' => 'required|string',
            'slug' => 'required|string',
            'summary' => 'nullable|string',
            'description' => 'nullable|string',
            'creator_id' => 'nullable|string',
            'course_id' => 'nullable|string',
            'section_id' => 'nullable|string',
            'status' => 'nullable|string',
            'date_time_from' => 'nullable|date_format:Y-m-d H:i|before:date_time_to',
            'date_time_to' => 'nullable|date_format:Y-m-d H:i|after:date_time_from',
            'webinar_url' => 'nullable|string',
            'can_users_reserve' => 'nullable|string',
            'is_recorded' => 'nullable|string',
        ]);
    }
}
