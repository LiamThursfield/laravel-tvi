<?php

namespace App\Http\Requests\Admin\EDU\Webinar;

use App\Http\Requests\BaseIndexRequest;

class WebinarUpdateRequest extends BaseIndexRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'summary' => 'nullable|string',
            'description' => 'nullable|string',
            'creator_id' => 'required',
            'course_id' => 'required',
            'section_id' => 'nullable',
            'status' => 'nullable|string',
            'date_time_from' => 'nullable|date_format:Y-m-d H:i|before:date_time_to',
            'date_time_to' => 'nullable|date_format:Y-m-d H:i|after:date_time_from',
            'webinar_url' => 'nullable|string',
            'can_users_reserve' => 'nullable|bool',
            'is_recorded' => 'nullable|bool',
        ];
    }
}
