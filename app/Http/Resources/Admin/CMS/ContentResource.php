<?php

namespace App\Http\Resources\Admin\CMS;

use App\Interfaces\CMS\TemplateFieldInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class ContentResource extends JsonResource
{

    public $preserveKeys = true;

    public function toArray($request)
    {
        $data = $this->data;
        if (in_array($this->template_field_type, TemplateFieldInterface::JSON_TYPES)) {
            $data = json_decode($data, true);
        }

        return [
            'data'              => $data,
            'id'                => $this->id,
            'template_field'    => TemplateFieldResource::make($this->whenLoaded('templateField')),
            'template_field_id' => $this->template_field_id,
        ];
    }
}
