<?php

namespace Tests\Feature\Admin;

use App\Interfaces\RoleInterface;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

class UserRoleTest extends AbstractAdminTestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_super_only_has_the_option_to_select_super_roles()
    {
        $user = User::factory()->create();
        $user->assignRole(RoleInterface::SUPER);

        self::assertEquals(
            RoleInterface::SUPER_SELECTABLE_ROLES,
            $user->getSelectableRoles(true)
        );

        // Assigning other roles, should should result in (at least) being able
        // to select the Admin selectable roles
        $user->assignRole(RoleInterface::ADMIN);
        $user->assignRole(RoleInterface::USER);

        $selectable_roles = $user->getSelectableRoles(true);
        foreach (RoleInterface::SUPER_SELECTABLE_ROLES as $role) {
            self::assertContains($role, $selectable_roles);
        }
    }

    /** @test */
    public function an_admin_only_has_the_option_to_select_admin_roles()
    {
        $user = User::factory()->create();
        $user->assignRole(RoleInterface::ADMIN);

        self::assertEquals(
            RoleInterface::ADMIN_SELECTABLE_ROLES,
            $user->getSelectableRoles(true)
        );

        // Assigning other roles, should should result in (at least) being able
        // to select the Admin selectable roles
        $user->assignRole(RoleInterface::USER);
        $user->assignRole(RoleInterface::SUPER);

        $selectable_roles = $user->getSelectableRoles(true);
        foreach (RoleInterface::ADMIN_SELECTABLE_ROLES as $role) {
            self::assertContains($role, $selectable_roles);
        }
    }
}
