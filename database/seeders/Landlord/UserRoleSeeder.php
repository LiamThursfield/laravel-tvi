<?php

namespace Database\Seeders\Landlord;

use App\Interfaces\Landlord\RoleInterface;
use App\Models\Landlord\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $originalDriver = auth()->getDefaultDriver();
        auth()->setDefaultDriver('landlord-web');

        $user = User::factory()->create([
            'first_name'    => 'Admin',
            'last_name'     => 'Account',
            'email'         => 'admin@example.com',
            'password'      => Hash::make('AdminPassword')
        ]);
        $user->assignRole(Role::whereName(RoleInterface::ADMIN)->first());

        $user = User::factory()->create([
            'first_name'    => 'Super',
            'last_name'     => 'Account',
            'email'         => 'super@example.com',
            'password'      => Hash::make('SuperPassword')
        ]);
        $user->assignRole(Role::whereName(RoleInterface::ADMIN)->first());
        $user->assignRole(Role::whereName(RoleInterface::SUPER)->first());

        auth()->setDefaultDriver($originalDriver);
    }
}
