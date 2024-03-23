<?php

namespace App\Actions\CMS\Redirect;

use App\Models\CMS\Redirect;

class RedirectUpdateAction
{
    public function handle(Redirect $redirect, array $redirect_data, bool $refresh = false): Redirect
    {
        $redirect->update($redirect_data);

        if ($refresh) {
            $redirect->refresh();
        }

        return $redirect;
    }
}
