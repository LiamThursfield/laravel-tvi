<?php

namespace App\Http\Requests\Admin\EDU\Label;

use App\Http\Requests\BaseIndexRequest;

class LabelStoreRequest extends BaseIndexRequest
{
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            'label' => 'required|string',
            'slug' => 'required|string|unique:edu_labels',
        ]);
    }
}
