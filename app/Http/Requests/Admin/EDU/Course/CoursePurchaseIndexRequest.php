<?php

namespace App\Http\Requests\Admin\EDU\Course;

use App\Http\Requests\BaseIndexRequest;

class CoursePurchaseIndexRequest extends BaseIndexRequest
{
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            'course_purchase_course_id'     => 'nullable|string',
            'course_purchase_email_address' => 'nullable|string',
            'course_purchase_status'        => 'nullable|string',
            'course_purchase_type'          => 'nullable|string',
            'course_purchase_user_id'       => 'nullable|string',
        ]);
    }
}
