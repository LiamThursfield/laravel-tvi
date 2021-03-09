<?php

namespace App\Traits\CMS;

use App\Http\Resources\Web\CMS\ContentResource;
use App\Http\Resources\Web\CMS\MenuResource;
use App\Interfaces\CMS\TemplateFieldInterface;
use App\Models\CMS\Menu;

trait ResourceHasContent
{
    protected function formatContent()
    {
        $content = ContentResource::collection($this->content)->keyBy('templateField.slug');

        // Loop through the content and get any "relation" fields
        $menu_fields = [];

        foreach ($content as $template_field_slug => $c) {
            if ($c->template_field_type === TemplateFieldInterface::TYPE_CMS_MENU) {
                $menu_fields[$template_field_slug] = $c->data;
            }
        }

        // Load any menus
        $menu_ids = array_unique($menu_fields);

        if (count($menu_ids)) {
            $menus = Menu::whereIn('id', $menu_ids)->get()->keyBy('id');
            foreach ($menu_fields as $template_field_slug => $menu_id) {

                $content[$template_field_slug]['data'] = $menus->get($menu_id) ?
                    MenuResource::make($menus->get($menu_id)) :
                    null;
            }
        }

        return $content;
    }
}
