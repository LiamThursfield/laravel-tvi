<?php

namespace App\Actions\EDU\Programme;

use App\Models\EDU\Programme\Announcement;

class ProgrammeStoreAction
{
    public function handle(array $data)
    {
        return Announcement::create($data);
    }
}
