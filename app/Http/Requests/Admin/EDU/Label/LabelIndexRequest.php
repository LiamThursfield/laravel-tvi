<?php

namespace App\Http\Requests\Admin\EDU\Label;

use App\Http\Requests\BaseIndexRequest;

class LabelIndexRequest extends BaseIndexRequest
{
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            'label_name' => 'nullable|string',
        ]);
    }
}
