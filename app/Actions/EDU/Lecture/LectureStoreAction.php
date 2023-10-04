<?php

namespace App\Actions\EDU\Lecture;

use App\Models\EDU\Lecture\Lecture;
use Illuminate\Support\Str;

class LectureStoreAction
{
    public function handle(array $data) : Lecture
    {
        $data['slug'] = Str::slug($data['title']);

        return Lecture::create($data);
    }
}
