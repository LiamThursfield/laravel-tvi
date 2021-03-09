<?php

namespace App\Http\Requests\Api\CMS;

use Illuminate\Foundation\Http\FormRequest;

class PageShowRequest extends FormRequest
{
    public function rules() : array
    {
        return [
            'page_url' => 'required|string'
        ];
    }
}
