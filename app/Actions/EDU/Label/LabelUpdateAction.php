<?php

namespace App\Actions\EDU\Label;

use App\Models\EDU\Label\Label;

class LabelUpdateAction
{
    public function handle(Label $label, array $data): ?Label
    {
        $label->update($data);

        return $label->fresh();
    }
}
