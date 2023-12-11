<?php

namespace App\Http\Requests\Admin\EDU\Purchase;

use App\Http\Requests\BaseIndexRequest;

class PurchaseIndexRequest extends BaseIndexRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'payment_status' => 'nullable|string',
            'email_address' => 'nullable|string'
        ]);
    }
}
