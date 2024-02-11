<?php

namespace App\Http\Resources\Web\EDU;

use App\Models\EDU\Course\CourseInstalmentPlan;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseShowResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'banner' => $this->banner,
            'current_price' => $this->current_price,
            'discount_price' => $this->discount_price,
            'description' => $this->description,
            'id' => $this->id,
            'instalment_plans' => CourseInstalmentPlanResource::collection($this->whenLoaded('instalmentPlans'))->sortBy('instalment_count')->keyBy('id'),
            'name' => $this->name,
            'price' => $this->price,
            'primary_image' => $this->primary_image,
            'summary' => $this->summary,
            'slug' => $this->slug,
        ];
    }
}
