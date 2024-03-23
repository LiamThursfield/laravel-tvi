<?php

namespace App\Actions\CMS\Redirect;


use App\Models\CMS\Redirect;

class RedirectStoreAction
{
    public function handle(array $redirect_data): Redirect
    {
        return Redirect::create($redirect_data);
    }
}
