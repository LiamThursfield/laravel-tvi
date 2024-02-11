<?php

namespace App\Http\Requests\Admin\EDU\Label;

use App\Http\Requests\BaseIndexRequest;

class LabelStoreRequest extends BaseIndexRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'name' => 'required|string|unique:edu_labels',
            'slug' => 'required|string|unique:edu_labels',
        ]);
    }
}
