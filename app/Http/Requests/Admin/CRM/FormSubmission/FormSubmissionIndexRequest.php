<?php

namespace App\Http\Requests\Admin\CRM\FormSubmission;

use App\Http\Requests\BaseIndexRequest;

class FormSubmissionIndexRequest extends BaseIndexRequest
{
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            'form_id' => 'nullable|numeric',
        ]);
    }
}
