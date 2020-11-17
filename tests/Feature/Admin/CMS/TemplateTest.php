<?php

namespace Tests\Feature\Admin\CMS;

use App\Interfaces\PermissionInterface;
use App\Models\CMS\Template;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Admin\AbstractAdminTestCase;

class TemplateTest extends AbstractAdminTestCase
{
    use RefreshDatabase;

    /** @test */
    public function authorised_users_can_create_users()
    {
        $response = $this
            ->signInWithPermissions(PermissionInterface::CREATE_CMS)
            ->get(route('admin.cms.templates.create'));
        $response->assertStatus(200);
    }

    /** @test */
    public function authorised_users_can_delete_users()
    {
        $template = Template::factory()->create();

        $this
            ->signInWithPermissions(PermissionInterface::DELETE_CMS)
            ->delete(route('admin.cms.templates.destroy', $template));

        $this->expectException(ModelNotFoundException::class);
        Template::findOrFail($template->id);
    }

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
