<?php

namespace App\Http\Resources\Web\EDU;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseInstalmentPlanResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'course' => CourseShowResource::make($this->whenLoaded('course')),
            'course_id' => $this->course_id,
            'currency' => $this->currency,
            'id' => $this->id,
            'instalment_count' => $this->instalment_count,
            'instalment_current_price' => $this->instalment_current_price,
            'instalment_discount_price' => $this->instalment_discount_price,
            'instalment_price' => $this->instalment_price,
        ];
    }
}
