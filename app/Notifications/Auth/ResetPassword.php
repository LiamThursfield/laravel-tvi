<?php

namespace App\Notifications\Auth;

use App\Interfaces\RoleInterface;
use App\Providers\RouteServiceProvider;

class ResetPassword extends  \Illuminate\Auth\Notifications\ResetPassword
{
    /**
     * Where to redirect users after reset.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_STUDENT;


    protected function resetUrl($notifiable)
    {
        $routeName = $notifiable->hasRole(RoleInterface::STUDENT) ?
            'password.reset' : 'student.password.reset';

        return url(route($routeName, [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));
    }
}