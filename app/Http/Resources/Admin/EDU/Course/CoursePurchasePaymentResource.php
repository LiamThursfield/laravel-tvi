<?php

namespace App\Http\Resources\Admin\EDU\Course;

use Illuminate\Http\Resources\Json\JsonResource;

class CoursePurchasePaymentResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'due_date' => $this->due_date,
            'currency' => $this->currency,
            'id' => $this->id,
            'paid_at' => $this->paid_at,
            'payment_gateway_response' => $this->payment_gateway_response,
            'payment_gateway_response_id' => $this->payment_gateway_response_id,
            'price' => $this->price,
            'purchase_id' => $this->course_purchase_id,
            'purchase' => CoursePurchaseResource::make($this->whenLoaded('purchase')),
            'status' => $this->status,
        ];
    }
}
