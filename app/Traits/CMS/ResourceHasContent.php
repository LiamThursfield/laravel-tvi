<?php

namespace App\Traits\CMS;

use App\Http\Resources\Web\CMS\ContentResource;
use App\Http\Resources\Web\CMS\MenuResource;
use App\Http\Resources\Web\CRM\FormResource;
use App\Interfaces\CMS\TemplateFieldInterface;
use App\Models\CMS\Menu;
use App\Models\CRM\Form;

trait ResourceHasContent
{
    protected function formatContent()
    {
        $content = ContentResource::collection($this->content)->keyBy('templateField.slug');

        // Loop through the content and get any "relation" fields
        $menu_fields = [];
        $form_fields = [];

        foreach ($content as $template_field_slug => $c) {
            if ($c->template_field_type === TemplateFieldInterface::TYPE_CMS_MENU) {
                $menu_fields[$template_field_slug] = $c->data;
            } elseif ($c->template_field_type === TemplateFieldInterface::TYPE_CRM_FORM) {
                $form_fields[$template_field_slug] = $c->data;
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

        // Load any forms
        $form_ids = array_unique($form_fields);
        if (count($form_ids)) {
            $forms = Form::whereIn('id', $form_ids)->with('formFields')->get()->keyBy('id');
            foreach ($form_fields as $template_field_slug => $form_id) {
                $content[$template_field_slug]['data'] = $forms->get($form_id) ?
                    FormResource::make($forms->get($form_id)) :
                    null;
            }
        }

        return $content;
    }
}
