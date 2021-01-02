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
        // Default Layout Template
        $template = Template::create([
            'type'          => TemplateInterface::TYPE_LAYOUT,
            'name'          => 'Default Layout Template',
            'slug'          => 'default-layout-template',
            'description'   => 'Default template for layouts.',
        ]);

        $template->templateFields()->create([
            'type'  => TemplateFieldInterface::TYPE_TEXT,
            'name'  => 'Shared Content',
            'slug'  => 'shared-content',
            'order' => 0,
        ]);

        $layout = Layout::create([
            'name'          => 'Default Layout',
            'slug'          => 'default-layout',
            'template_id'   => $template->id,
        ]);



        // Default Page Template
        $template = Template::create([
            'type'          => TemplateInterface::TYPE_PAGE,
            'name'          => 'Default Page Template',
            'slug'          => 'default-page-template',
            'description'   => 'Default template for pages.',
        ]);

        $template->templateFields()->create([
            'type'  => TemplateFieldInterface::TYPE_TEXT,
            'name'  => 'Header',
            'slug'  => 'header',
            'order' => 0,
        ]);

        $template->templateFields()->create([
            'type'  => TemplateFieldInterface::TYPE_WYSIWYG,
            'name'  => 'Content',
            'slug'  => 'content',
            'order' => 0,
        ]);
    }
}
