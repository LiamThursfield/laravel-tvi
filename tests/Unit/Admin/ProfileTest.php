<?php

namespace Tests\Unit\Admin;

use App\Interfaces\PermissionInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;


    /** @test  */
    public function authorised_users_can_view_their_profile()
    {
        $response = $this
            ->signInWithPermissions(PermissionInterface::VIEW_PROFILE)
            ->get(route('admin.profile.index'));

        $response
            ->assertStatus(200)
            ->assertPropValue('profile.email', Auth::user()->email);
    }

    /** @test  */
    public function unauthorised_users_cannot_view_their_profile()
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
}
