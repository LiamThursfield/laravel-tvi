<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UserStoreAction
{
    public function handle(array $user_data) : User
    {
        // Extract the roles data if it exists
        $roles_data = Arr::get($user_data, 'roles', []);
        unset($user_data['roles']);

        try {
            DB::beginTransaction();

            $user = User::create($user_data);
            $user = app(UserSetRolesAction::class)->handle($user, $roles_data);

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
