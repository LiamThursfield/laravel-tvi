<?php

namespace Database\Seeders;

use App\Interfaces\RoleInterface;
use App\Models\User;
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

        $user = User::factory()->create([
            'first_name'    => 'Admin',
            'last_name'     => 'Account',
            'email'         => 'admin@example.com',
            'password'      => Hash::make('AdminPassword')
        ]);
        $user->assignRole(Role::whereName(RoleInterface::ADMIN)->first());
        $user->assignRole(Role::whereName(RoleInterface::USER)->first());

        $user = $user = User::factory()->create([
            'first_name'    => 'Super',
            'last_name'     => 'Account',
            'email'         => 'super@example.com',
            'password'      => Hash::make('SuperPassword')
        ]);
        $user->assignRole(Role::whereName(RoleInterface::ADMIN)->first());
        $user->assignRole(Role::whereName(RoleInterface::SUPER)->first());
        $user->assignRole(Role::whereName(RoleInterface::USER)->first());

        $user = $user = User::factory()->create([
            'first_name'    => 'User',
            'last_name'     => 'Account',
            'email'         => 'user@example.com',
            'password'      => Hash::make('UserPassword')
        ]);
        $user->assignRole(Role::whereName(RoleInterface::USER)->first());
    }
}
