<?php

namespace App\Http\Requests\Admin\EDU\Section;

use App\Http\Requests\BaseIndexRequest;

class SectionIndexRequest extends BaseIndexRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'section_title' => 'nullable|string',
            'section_slug' => 'nullable|string',
        ]);
    }
}
