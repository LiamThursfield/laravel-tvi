<?php

namespace App\Http\Requests\Admin\CRM\Form;

use App\Http\Requests\BaseIndexRequest;

class FormIndexRequest extends BaseIndexRequest
{
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            'form_name'     => 'nullable|string',
            'form_slug'     => 'nullable|string',
        ]);
    }
}
