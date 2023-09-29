<?php

namespace App\Http\Requests\Api\EDU\Course;

use Illuminate\Foundation\Http\FormRequest;

class CourseShowRequest extends FormRequest
{
    public function rules() : array
    {
        return [
//            'page_url' => 'required|string'
        ];
    }
}
