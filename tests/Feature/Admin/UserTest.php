<?php

namespace Tests\Feature\Admin;

use App\Interfaces\PermissionInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends AbstractAdminTestCase
{
    use RefreshDatabase;

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
    public function unauthorised_users_cannot_delete_users()
    {
        $user = User::factory()->create();

        $this->assertIsPermissionAuthenticatedRoute(route('admin.users.destroy', $user), 'delete');

        $this->assertEquals($user->email, User::findOrFail($user->id)->email);
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
