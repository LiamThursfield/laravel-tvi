<?php

namespace Tests\Feature\Admin\CMS;

use App\Interfaces\CMS\TemplateFieldInterface;
use App\Interfaces\CMS\TemplateInterface;
use App\Interfaces\PermissionInterface;
use App\Models\CMS\Template;
use App\Models\CMS\TemplateField;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Admin\AbstractAdminTestCase;

class TemplateTest extends AbstractAdminTestCase
{
    use RefreshDatabase;

    /** @test */
    public function authorised_users_can_create_templates()
    {
        $response = $this
            ->signInWithPermissions(PermissionInterface::CREATE_CMS)
            ->get(route('admin.cms.templates.create'));
        $response->assertStatus(200);
    }

    /** @test */
    public function authorised_users_can_destroy_templates()
    {
        $template = Template::factory()->create();

        $this
            ->signInWithPermissions(PermissionInterface::DELETE_CMS)
            ->delete(route('admin.cms.templates.destroy', $template));

        $this->expectException(ModelNotFoundException::class);
        Template::findOrFail($template->id);
    }

    /** @test */
    public function authorised_users_can_edit_templates()
    {
        $this->withoutExceptionHandling();

        $template = Template::factory()
            ->has(TemplateField::factory()->count(2))
            ->create();

        $response = $this
            ->signInWithPermissions(PermissionInterface::EDIT_CMS)
            ->get(route('admin.cms.templates.edit', $template));

        $response
            ->assertStatus(200)
            ->assertPropValue('template.id', $template->id);
    }


    /** @test */
    public function authorised_users_can_store_templates()
    {
        $template = [
            'description'       => 'A description',
            'name'              => 'Template Name',
            'slug'              => 'template-slug',
            'type'              => TemplateInterface::TYPE_LAYOUT,
            'template_fields'   => [
                [
                    'description'   => 'Description 1',
                    'is_required'   => true,
                    'name'          => 'Field One',
                    'order'         => 0,
                    'settings'      => [],
                    'slug'          => 'field-one',
                    'type'          => TemplateFieldInterface::TYPE_TEXT
                ],
                [
                    'description'   => 'Description 2',
                    'is_required'   => false,
                    'name'          => 'Field Two',
                    'order'         => 1,
                    'settings'      => [],
                    'slug'          => 'field-two',
                    'type'          => TemplateFieldInterface::TYPE_NUMBER
                ],
            ],
        ];

        $this
            ->signInWithPermissions(PermissionInterface::CREATE_CMS)
            ->post(route('admin.cms.templates.store', $template));

        // Ensure the template was created
        $new_template_query = Template::where('slug', $template['slug']);
        $this->assertEquals(1, $new_template_query->count());

        // Ensure the template fields were created
        $template_model = $new_template_query->first();
        $new_template_field_query = TemplateField::where('template_id', $template_model->id);
        $this->assertEquals(2, $new_template_field_query->count());
    }


    /** @test */
    public function unauthorised_users_cannot_create_templates()
    {
        $this->assertIsPermissionAuthenticatedRoute(route('admin.cms.templates.create'));
    }

    /** @test */
    public function unauthorised_users_cannot_destroy_templates()
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
