<?php

namespace App\Http\Requests\Admin\EDU\Label;

use App\Http\Requests\BaseIndexRequest;

class LabelStoreRequest extends BaseIndexRequest
{
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            'name'     => 'required|string',
            'summary'     => 'nullable|string',
            'description'     => 'nullable|string',
            'creator_id'     => 'required|exists:users,id',
            'status'     => 'nullable|string',
            'content_length_video' => 'nullable|string',
        ]);
    }
}
