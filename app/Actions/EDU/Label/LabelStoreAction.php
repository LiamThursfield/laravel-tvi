<?php

namespace App\Actions\EDU\Label;

use App\Models\EDU\Label\Label;

class LabelStoreAction
{
    public function handle(array $data) : Label
    {
        return Label::create($data);
    }
}
