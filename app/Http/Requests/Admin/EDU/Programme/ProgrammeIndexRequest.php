<?php

namespace App\Http\Requests\Admin\EDU\Programme;

use App\Http\Requests\BaseIndexRequest;

class ProgrammeIndexRequest extends BaseIndexRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'programme_name' => 'nullable|string',
            'programme_slug' => 'nullable|string',
        ]);
    }
}
