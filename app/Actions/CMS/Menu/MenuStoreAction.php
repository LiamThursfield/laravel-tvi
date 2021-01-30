<?php

namespace App\Actions\CMS\Menu;

use App\Models\CMS\Menu;

class MenuStoreAction
{
    public function handle(array $menu_data) : Menu
    {
        return Menu::create($menu_data);
    }
}
