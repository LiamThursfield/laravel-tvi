<?php

namespace App\Traits\Admin;

use Carbon\Carbon;
use Illuminate\Support\Str;

trait Slugify
{

    public function slugify(string $data): string
    {
        return Str::slug($data);
    }

    /**
     * Use this for slugs that are live and user facing.
     * This way we anonymize a bit the name to access courses/programmes and,
     * make it harder for them to guess our slugs.
     *
     * @param string $data
     * @return string
     */
    public function slugifyWithIso8601(string $data): string
    {
        return Str::slug($data) . '-' . Carbon::now()->toIso8601String();
    }

    public function slugifyWithUnix(string $data): string
    {
        return Str::slug($data) . '-' . Carbon::now()->unix();
    }
}
