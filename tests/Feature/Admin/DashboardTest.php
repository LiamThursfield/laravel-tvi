<?php

namespace Tests\Feature\Admin;

use App\Interfaces\Landlord\PermissionInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TenantTestCase;

class DashboardTest extends TenantTestCase
{
    use RefreshDatabase;

    public function test_authorised_users_can_view_the_dashboard()
    {
        $response = $this
            ->signInWithPermissions(PermissionInterface::VIEW_ADMIN)
            ->get(route('admin.index'));

        $response->assertStatus(200);
    }

    public function test_unauthorised_users_cannot_view_the_dashboard()
    {
        $response = $this
            ->signIn()
            ->get(route('admin.index'));

        $response->assertStatus(403);
    }

    public function test_guests_cannot_view_the_dashboard()
    {
        $response = $this->get(route('admin.index'));
        $response->assertRedirect(route('login'));
    }
}
