<?php

namespace App\Actions\CMS\Menu;

use App\Models\CMS\Menu;

class MenuUpdateAction
{
    public function handle(Menu $menu, array $menu_data) : Menu
    {
        $menu->update($menu_data);
        return $menu;
    }
}
