<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{

    protected function formatDate($value, ?String $default = null)  : ?String
    {
        return $this->formatDateTime($value, $default, false);
    }

    protected function formatDateTime($value, ?String $default = null, ?bool $include_time = true) : ?String
    {
        try {
            if ($value instanceof Carbon) {
                $format = 'Y-m-d';
                if ($include_time) {
                    $format .= ' H:i:s';
                }

                return $value->format($value, $format);
            }

            return $default;
        } catch (Exception $exception) {
            return $default;
        }
    }
}
