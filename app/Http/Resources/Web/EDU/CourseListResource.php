<?php

namespace App\Http\Resources\Web\EDU;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseListResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'discount_price' => $this->discount_price,
            'name' => $this->name,
            'price' => $this->price,
            'primary_image' => $this->primary_image,
            'slug' => $this->slug,
        ];
    }
}
