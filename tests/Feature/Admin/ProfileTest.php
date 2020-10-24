<?php

namespace Tests\Feature\Admin;

use App\Interfaces\PermissionInterface;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProfileTest extends AbstractAdminTestCase
{
    use RefreshDatabase;

    /** @test  */
    public function authorised_users_can_edit_their_profile()
    {
        $response = $this
            ->signInWithPermissions(PermissionInterface::EDIT_PROFILE)
            ->get(route('admin.profile.edit'));

        $response
            ->assertStatus(200)
            ->assertPropValue('profile.email', Auth::user()->email);
    }

    /** @test  */
    public function authorised_users_can_update_their_profile()
    {
        // Ensure validation errors are thrown
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $updates = [
            'email'      => 'NEW@EMAIL.COM',
            'first_name' => 'NEW_FIRST_NAME',
            'last_name'  => 'NEW_LAST_NAME',
        ];

        $response = $this->signInWithPermissions(PermissionInterface::EDIT_PROFILE, $user)
            ->put(route('admin.profile.update'), $updates);

        $response->assertStatus(302);

        // Ensure the user fields have been updated
        $user->refresh();
        foreach ($updates as $key => $value) {
            $this->assertEquals($value, $user->getAttribute($key));
        }
    }

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

    /** @test */
    public function unauthorised_users_cannot_edit_their_profile()
    {
        $this->assertIsPermissionAuthenticatedRoute(route('admin.profile.edit'));
    }

    /** @test */
    public function unauthorised_users_cannot_update_their_profile()
    {
        $this->assertIsPermissionAuthenticatedRoute(route('admin.profile.update'), 'put');
    }

    /** @test  */
    public function unauthorised_users_cannot_view_their_profile()
    {
        $this->assertIsPermissionAuthenticatedRoute(route('admin.profile.index'));
    }

    /** @test */
    public function users_can_enter_their_current_email_when_updating_their_profile()
    {
        // Ensure validation errors are thrown
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $updates = [
            'email'      => $user->email,
            'first_name' => 'NEW_FIRST_NAME',
            'last_name'  => 'NEW_LAST_NAME',
        ];

        $response = $this->signInWithPermissions(PermissionInterface::EDIT_PROFILE, $user)
            ->put(route('admin.profile.update'), $updates);

        $response->assertStatus(302);
    }

    /** @test */
    public function users_cannot_update_their_user_id_when_updating_their_profile()
    {
        $user = User::factory()->create();
        $user_id = $user->id;
        $updates = [
            'email'      => 'NEW@EMAIL.COM',
            'first_name' => 'NEW_FIRST_NAME',
            'id'         => $user_id + 10,
            'last_name'  => 'NEW_LAST_NAME',
        ];

        $this->signInWithPermissions(PermissionInterface::EDIT_PROFILE, $user)
            ->put(route('admin.profile.update'), $updates);

        // Ensure the user id has not changed
        $user->refresh();
        $this->assertEquals($user_id, $user->id);
    }

    /** @test */
    public function users_cannot_update_their_email_to_an_existing_email()
    {
        // Ensure validation errors are thrown
        $this->withoutExceptionHandling();

        $this->expectException(ValidationException::class);

        $user = User::factory()->create();
        $original_user_email = $user->email;
        $existing_user = User::factory()->create();

        $updates = [
            'email'      => $existing_user->email,
            'first_name' => 'NEW_FIRST_NAME',
            'last_name'  => 'NEW_LAST_NAME',
        ];

        $this->signInWithPermissions(PermissionInterface::EDIT_PROFILE, $user)
            ->put(route('admin.profile.update'), $updates);

        // Ensure the user email has not changed
        $user->refresh();
        $this->assertEquals($original_user_email, $user->email);
        $this->assertNotEquals($existing_user->email, $user->email);
    }
}
