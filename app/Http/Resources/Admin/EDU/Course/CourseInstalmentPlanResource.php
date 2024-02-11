<?php

namespace App\Http\Resources\Admin\EDU\Course;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseInstalmentPlanResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'course' => CourseResource::make($this->whenLoaded('course')),
            'currency' => $this->currency,
            'id' => $this->id,
            'instalment_count' => $this->instalment_count,
            'instalment_current_price' => $this->instalment_current_price,
            'instalment_price' => $this->instalment_price,
            'instalment_discount_price' => $this->instalment_discount_price,
        ];
    }
}
