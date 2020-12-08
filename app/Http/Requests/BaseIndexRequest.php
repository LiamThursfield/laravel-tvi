<?php

namespace App\Http\Requests;

class BaseIndexRequest extends BaseRequest
{
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            'order_by' => 'nullable|string',
            'order_direction' => 'nullable|string',
            'per_page' => 'nullable|integer',
        ]);
    }
}
