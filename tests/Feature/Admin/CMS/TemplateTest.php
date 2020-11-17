<?php

namespace Tests\Feature\Admin\CMS;

use App\Models\CMS\Template;
use App\Models\CMS\TemplateField;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Admin\AbstractAdminTestCase;

class TemplateTest extends AbstractAdminTestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthorised_users_cannot_create_templates()
    {
        $this->assertIsPermissionAuthenticatedRoute(route('admin.cms.templates.create'));
    }

    /** @test */
    public function unauthorised_users_cannot_delete_templates()
    {
        $template = Template::factory()->create();

        $this->assertIsPermissionAuthenticatedRoute(route('admin.cms.templates.destroy', $template), 'delete');

        self::assertEquals($template->id, Template::findOrFail($template->id)->id);
    }

    /** @test */
    public function unauthorised_users_cannot_edit_templates()
    {
        $template = Template::factory()->create();
        $this->assertIsPermissionAuthenticatedRoute(route('admin.cms.templates.edit', $template));
    }

    /** @test */
    public function unauthorised_users_cannot_store_templates()
    {
        $this->assertIsPermissionAuthenticatedRoute(route('admin.cms.templates.store'), 'post');
    }

    /** @test */
    public function unauthorised_users_cannot_update_templates()
    {
        $template = Template::factory()->create();
        $this->assertIsPermissionAuthenticatedRoute(route('admin.cms.templates.update', $template), 'put');
    }

    /** @test */
    public function unauthorised_users_cannot_view_templates()
    {
        $this->assertIsPermissionAuthenticatedRoute(route('admin.cms.templates.index'));
    }

}
