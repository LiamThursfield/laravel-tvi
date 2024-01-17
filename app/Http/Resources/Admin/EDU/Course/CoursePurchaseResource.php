<?php

namespace App\Http\Resources\Admin\EDU\Course;

use App\Http\Resources\Admin\User\UserEditResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursePurchaseResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'course' => CourseResource::make($this->whenLoaded('course')),
            'course_id' => $this->course_id,
            'created_at' => $this->created_at,
            'currency' => $this->currency,
            'email_address' => $this->email_address,
            'full_price_paid_at' => $this->full_price_paid_at,
            'instalment_plan' => CourseInstalmentPlanResource::make($this->whenLoaded('instalmentPlan')),
            'instalment_plan_id' => $this->instalment_plan_id,
            'is_refundable' => $this->is_refundable,
            'payment_gateway' => $this->payment_gateway,
            'purchase_payments' => CoursePurchasePaymentResource::collection($this->whenLoaded('purchasePayments')),
            'redeemed_at' => $this->redeemed_at,
            'status' => $this->status,
            'total_price_due' => $this->total_price_due,
            'total_price_paid' => $this->total_price_paid,
            'total_price_outstanding' => $this->total_price_outstanding,
            'type' => $this->type,
            'user' => UserEditResource::make($this->whenLoaded('loaded')),
            'user_id' => $this->user_id,
        ];
    }
}
