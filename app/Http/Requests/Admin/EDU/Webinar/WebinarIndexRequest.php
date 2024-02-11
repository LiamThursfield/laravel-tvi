<?php

namespace App\Http\Requests\Admin\EDU\Webinar;

use App\Http\Requests\BaseIndexRequest;

class WebinarIndexRequest extends BaseIndexRequest
{
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            'webinar_name' => 'nullable|string',
            'webinar_slug' => 'nullable|string',
        ]);
    }
}
