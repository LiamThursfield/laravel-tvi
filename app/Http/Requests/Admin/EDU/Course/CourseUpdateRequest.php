<?php

namespace App\Http\Requests\Admin\EDU\Course;

use App\Http\Requests\BaseIndexRequest;

class CourseUpdateRequest extends BaseIndexRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'name' => 'required|string',
            'slug' => 'required|string',
            'summary' => 'nullable|string',
            'description' => 'nullable|string',
            'creator_id' => 'required|exists:users,id',
            'status' => 'nullable|string',
            'available_from' => 'nullable|string',
            'available_to' => 'nullable|string',
            'content_length_video' => 'nullable|string',
            'banner' => 'nullable|string',
            'primary_image' => 'nullable|string',
            'video_preview' => 'nullable|string',
            'price' => 'nullable|string',
            'discount_price' => 'nullable|string',
            'currency' => 'nullable|string',
            'languages' => 'nullable|string',
            'has_webinars' => 'nullable|boolean',
            'has_money_back_guarantee' => 'nullable|boolean',
            'has_certificate' => 'nullable|boolean',
            'has_captions' => 'nullable|boolean',
            'has_lifetime_access' => 'nullable|boolean',
            'has_student_discount' => 'nullable|boolean',
            'has_pdfs' => 'nullable|boolean',
            'has_free_seo_exposure' => 'nullable|boolean',
        ]);
    }
}
