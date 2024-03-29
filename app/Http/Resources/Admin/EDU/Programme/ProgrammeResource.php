<?php

namespace App\Http\Resources\Admin\EDU\Programme;

use App\Http\Resources\Admin\EDU\Course\CourseResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgrammeResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'summary' => $this->summary,
            'description' => $this->description,
            'creator_id' => $this->creator_id,
            'creator' => $this->whenLoaded('creator'),
            'status' => $this->status,
            'available_from' => $this->available_from,
            'available_to' => $this->available_to,
            'content_length_video' => $this->content_length_video,
            'banner' => $this->banner,
            'primary_image' => $this->primary_image,
            'video_preview' => $this->video_preview,
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'currency' => $this->currency,
            'languages' => $this->languages,
            'has_webinars' => (bool)$this->has_webinars,
            'has_money_back_guarantee' => (bool)$this->has_money_back_guarantee,
            'has_certificate' => (bool)$this->has_certificate,
            'has_captions' => (bool)$this->has_captions,
            'has_lifetime_access' => (bool)$this->has_lifetime_access,
            'has_student_discount' => (bool)$this->has_student_discount,
            'has_pdfs' => (bool)$this->has_pdfs,
            'has_free_seo_exposure' => (bool)$this->has_free_seo_exposure,
            'courses' => $this->whenLoaded('courses') ?? CourseResource::make($this->whenLoaded('courses')),
            'courses_count' => $this->courses->count() ?? 0,
        ];
    }
}
