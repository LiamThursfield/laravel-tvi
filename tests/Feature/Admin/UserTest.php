<?php

namespace Tests\Feature\Admin;

use App\Interfaces\PermissionInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;

class UserTest extends AbstractAdminTestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_cannot_be_stored_with_an_email_belonging_to_another_user()
    {
        // Ensure validation errors are thrown
        $this->withoutExceptionHandling();

        $this->expectException(ValidationException::class);

        $existing_user = User::factory()->create();

        $new_user = [
            'email'      => $existing_user->email,
            'first_name' => 'FNAME',
            'last_name' => 'LNAME',
            'password' => "TESTPASSOWRD1",
            'password_confirmation' => "TESTPASSOWRD1",
        ];

        $this->signInWithPermissions(PermissionInterface::CREATE_USERS)
            ->post(route('admin.users.store'), $new_user);
    }

    /** @test */
    public function a_user_cannot_be_updated_with_an_email_belonging_to_another_user()
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

        $this->signInWithPermissions(PermissionInterface::EDIT_USERS)
            ->put(route('admin.users.update', $user), $updates);

        // Ensure the user email has not changed
        $user->refresh();
        $this->assertEquals($original_user_email, $user->email);
        $this->assertNotEquals($existing_user->email, $user->email);
    }

    /** @test */
    public function authorised_users_can_create_users()
    {
        $response = $this
            ->signInWithPermissions(PermissionInterface::CREATE_USERS)
            ->get(route('admin.users.create'));
        $response->assertStatus(200);
    }

    /** @test */
    public function authorised_users_can_delete_users()
    {
        $user = User::factory()->create();

        $response = $this
            ->signInWithPermissions(PermissionInterface::DELETE_USERS)
            ->delete(route('admin.users.destroy', $user));

        $response->assertStatus(303);

        $this->expectException(ModelNotFoundException::class);
        User::findOrFail($user->id);
    }

    /** @test */
    public function authorised_users_can_edit_users()
    {
        $user_to_edit = User::factory()->create();

        $response = $this
            ->signInWithPermissions(PermissionInterface::EDIT_USERS)
            ->get(route('admin.users.edit', $user_to_edit));

        $response
            ->assertStatus(200)
            ->assertSee($user_to_edit->name);
    }

    /** @test */
    public function authorised_users_can_store_users()
    {
        $user = [
            'email'                 => 'test@test.com',
            'first_name'            => 'first',
            'last_name'             => 'first',
            'password'              => 'Password1234',
            'password_confirmation' => 'Password1234',
        ];

        $this
            ->signInWithPermissions(PermissionInterface::CREATE_USERS)
            ->post(route('admin.users.store', $user));

        $new_user_query = User::where('email', $user['email']);

        $this->assertCount(1, $new_user_query->get());

        $new_user = $new_user_query->first();
        $this->assertEquals($user['first_name'], $new_user->first_name);
        $this->assertEquals($user['last_name'], $new_user->last_name);
    }

    /** @test */
    public function authorised_users_can_update_users()
    {
        // Ensure validation errors are thrown
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $updates = [
            'email'      => 'NEW@EMAIL.COM',
            'first_name' => 'NEW_FIRST_NAME',
            'last_name'  => 'NEW_LAST_NAME',
        ];

        $response = $this
            ->signInWithPermissions(PermissionInterface::EDIT_USERS)
            ->put(route('admin.users.update', $user), $updates);

        $response->assertStatus(302);

        $user->refresh();
        foreach ($updates as $key => $value) {
            $this->assertEquals($value, $user->getAttribute($key));
        }
    }

    /** @test */
    public function authorised_users_can_view_users()
    {
        $user = User::factory()->create();

        $response = $this
            ->signInWithPermissions(PermissionInterface::VIEW_USERS)
            ->get(route('admin.users.index'));

        $response
            ->assertStatus(200)
            ->assertSee($user->email);
    }

    /** @test */
    public function unauthorised_users_cannot_create_users()
    {
        $this->assertIsPermissionAuthenticatedRoute(route('admin.users.create'));
    }

    /** @test */
    public function unauthorised_users_cannot_delete_users()
    {
        $user = User::factory()->create();

        $this->assertIsPermissionAuthenticatedRoute(route('admin.users.destroy', $user), 'delete');

        $this->assertEquals($user->email, User::findOrFail($user->id)->email);
    }

    /** @test */
    public function unauthorised_users_cannot_edit_users()
    {
        $user = User::factory()->create();
        $this->assertIsPermissionAuthenticatedRoute(route('admin.users.edit', $user));
    }

    /** @test */
    public function unauthorised_users_cannot_store_users()
    {
        $this->assertIsPermissionAuthenticatedRoute(route('admin.users.store'), 'post');
    }

    /** @test */
    public function unauthorised_users_can_update_users()
    {
        $user = User::factory()->create();
        $this->assertIsPermissionAuthenticatedRoute(route('admin.users.update', $user), 'put');
    }

    /** @test */
    public function unauthorised_users_cannot_view_users()
    {
        $this->assertIsPermissionAuthenticatedRoute(route('admin.users.index'));
    }

    /** @test */
    public function users_cannot_delete_themselves()
    {
        $user = User::factory()->create();

        $response = $this
            ->signInWithPermissions(PermissionInterface::DELETE_USERS, $user)
            ->delete(route('admin.users.destroy', $user));

        // TODO: Look for a better way, I do not like checking for a string like this
        $this->followRedirects($response)
            ->assertSee('Deleting your own user is not allowed');

        $this->assertEquals($user->email, User::findOrFail($user->id)->email);
    }
}
