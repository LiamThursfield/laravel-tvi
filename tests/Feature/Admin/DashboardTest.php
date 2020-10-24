<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;


    /** @test  */
    public function authorised_users_can_view_the_dashboard()
    {
        $response = $this
            ->signIn()
            ->get(route('admin.index'));

        $response->assertStatus(200);
    }

    /** @test  */
    public function unauthorised_users_cannot_view_the_dashboard()
    {
        $response = $this->get(route('admin.index'));
        $response->assertRedirect(route('login'));
    }
}
