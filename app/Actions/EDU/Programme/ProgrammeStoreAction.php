<?php

namespace App\Actions\EDU\Programme;

use App\Models\EDU\Programme\Programme;

class ProgrammeStoreAction
{
    public function handle(array $data)
    {
        return Programme::create($data);
    }
}
