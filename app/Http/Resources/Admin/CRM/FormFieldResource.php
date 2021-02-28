<?php

namespace App\Http\Resources\Admin\CRM;

use App\Interfaces\CRM\FormFieldInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class FormFieldResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'form'              => FormResource::make($this->whenLoaded('form')),
            'form_id'           => $this->form_id,
            'id'                => $this->id,
            'is_required'       => $this->is_required ?? false,
            'name'              => $this->name,
            'order'             => $this->order ?? 0,
            'settings'          => $this->settings ?? [],
            'slug'              => $this->slug,
            'type'              => $this->type,
            'type_label'        => Arr::get(
                FormFieldInterface::ALL_TYPES_LABELLED,
                $this->type,
                $this->type
            ),
        ];
    }
}
