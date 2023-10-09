<?php

namespace App\Actions\EDU\Programme;

use App\Models\EDU\Programme\Programme;

class ProgrammeUpdateAction
{
    public function handle(Programme $programme, array $data): ?Programme
    {
        $programme->update($data);

        return $programme->fresh();
    }
}
