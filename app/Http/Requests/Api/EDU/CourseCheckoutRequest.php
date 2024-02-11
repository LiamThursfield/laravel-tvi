<?php

namespace App\Http\Requests\Api\EDU;

use Illuminate\Foundation\Http\FormRequest;

class CourseCheckoutRequest extends FormRequest
{
    public function rules() : array
    {
        return [
            'instalment_plan_id' => 'nullable|int'
        ];
    }
}
