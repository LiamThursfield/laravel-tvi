<?php

namespace Database\Seeders;

use App\Interfaces\CMS\TemplateFieldInterface;
use App\Interfaces\CMS\TemplateInterface;
use App\Models\CMS\Layout;
use App\Models\CMS\Template;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createLayoutTemplate();
        $this->createPageTemplate();
    }


    protected function createLayoutTemplate()
    {
        $template = Template::create([
            'description'   => 'Default template for layouts.',
            'name'          => 'Default Layout Template',
            'slug'          => 'default-layout-template',
            'type'          => TemplateInterface::TYPE_LAYOUT,
        ]);

        $template->templateFields()->create([
            'name'  => 'Shared Content',
            'order' => 0,
            'slug'  => 'shared-content',
            'type'  => TemplateFieldInterface::TYPE_TEXT,
        ]);


        Layout::create([
            'name'          => 'Default Layout',
            'slug'          => 'default-layout',
            'template_id'   => $template->id,
        ]);
    }

    protected function createPageTemplate()
    {
        $template = Template::create([
            'description'   => 'Default template for pages.',
            'name'          => 'Default Page Template',
            'slug'          => 'default-page-template',
            'type'          => TemplateInterface::TYPE_PAGE,
        ]);

        $template->templateFields()->createMany([
            [
                'name'  => 'Header',
                'order' => 0,
                'slug'  => 'header',
                'type'  => TemplateFieldInterface::TYPE_TEXT,
            ],
            [
                'name'  => 'Content',
                'order' => 1,
                'slug'  => 'content',
                'type'  => TemplateFieldInterface::TYPE_WYSIWYG,
            ],
        ]);
    }
}
