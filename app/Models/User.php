<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var array
     */
    protected $appends = [
        'name'
    ];


    /**
     * Helper to return first + last name
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * TODO: This needs a better name.
     * Return the permissions that a user has in array format
     * To allow for dot notation access
     * @return array[]
     */
    public function getPermissionsArrayAttribute()
    {
        return [
            'users' => [
                'view'      => $this->hasPermissionTo('view users'),
                'create'    => $this->hasPermissionTo('create users'),
                'edit'      => $this->hasPermissionTo('edit users'),
                'delete'    => $this->hasPermissionTo('delete users'),
            ]
        ];
    }
}
