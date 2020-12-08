<?php

namespace Database\Seeders;

use App\Interfaces\CMS\TemplateFieldInterface;
use App\Interfaces\CMS\TemplateInterface;
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
        $layout = Template::create([
            'type' => TemplateInterface::TYPE_LAYOUT,
            'name' => 'Default Layout Template',
            'slug' => 'default-layout-template',
            'description' => 'Default template for layouts.',
        ]);

        $layout->templateFields()->create([
            'type' => TemplateFieldInterface::TYPE_TEXT,
            'name' => 'Shared Content',
            'slug' => 'shared-content',
            'order' => 0,
        ]);



        // Default Page Template
        $page = Template::create([
            'type' => TemplateInterface::TYPE_PAGE,
            'name' => 'Default Page Template',
            'slug' => 'default-page-template',
            'description' => 'Default template for pages.',
        ]);

        $page->templateFields()->create([
            'type' => TemplateFieldInterface::TYPE_TEXT,
            'name' => 'Header',
            'slug' => 'header',
            'order' => 0,
        ]);

        $page->templateFields()->create([
            'type' => TemplateFieldInterface::TYPE_WYSIWYG,
            'name' => 'Content',
            'slug' => 'content',
            'order' => 0,
        ]);
    }
}
