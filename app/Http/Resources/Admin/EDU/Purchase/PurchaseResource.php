<?php

namespace App\Http\Resources\Admin\EDU\Purchase;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'payment_status' => $this->payment_status,
            'is_refundable' => $this->is_refundable,
            'email_address' => $this->email_address,
            'user_id' => $this->user_id,
            'user' => $this->whenLoaded('user'),
            'redeemed_at' => $this->redeemed_at,
            'payment_currency' => $this->payment_currency,
            'payment_total' => $this->payment_total,
            'payment_gateway' => $this->payment_gateway,
            'payment_gateway_response_id' => $this->payment_gateway_response_id,
            'payment_response' => $this->payment_response,
        ];
    }
}
