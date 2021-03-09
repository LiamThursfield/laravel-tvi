<?php

namespace App\Console\Commands;

use App\Interfaces\RoleInterface;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateSuperUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create-super';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a super user';


    public function handle() : void
    {
        $firstName = $this->ask('What is your first name?');
        $lastName = $this->ask('What is your last name?');
        $email = $this->ask('What is your email?');

        $password = $this->secret('Create password');
        if (!$password || strlen($password) < 8) {
            $this->error('Password must be at least 8 characters.');
            return;
        }

        $passwordConfirmation = $this->secret('Confirm password');
        if ($password !== $passwordConfirmation) {
            $this->error('Passwords do not match.');
            return;
        }

        $user = User::create([
            'first_name'    => $firstName,
            'last_name'     => $lastName,
            'email'         => $email,
            'password'      => Hash::make($password),
        ]);

        $user->assignRole(Role::whereName(RoleInterface::SUPER)->first());

        $this->comment('User Created: ' . $user->name);
    }
}
