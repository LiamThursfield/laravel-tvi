<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function unauthorised_users_cannot_view_the_dashboard()
    {
        // Guests
        $response = $this->get(route('admin.profile.index'));
        $response->assertRedirect(route('login'));

        // User with no permissions
        $response = $this
            ->signIn()
            ->get(route('admin.profile.index'));
        $response->assertStatus(403);
    }

    /** @test  */
    public function authorised_users_can_view_the_dashboard()
    {
        $response = $this
            ->signInWithUserRole()
            ->get(route('admin.profile.index'));

        $response
            ->assertStatus(200)
            ->assertPropValue('profile.email', Auth::user()->email);
    }
}
