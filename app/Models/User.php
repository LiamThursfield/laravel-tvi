<?php

namespace App\Models;

use App\Interfaces\PermissionInterface;
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
     * Return all permissions and whether or not the user has them, in array format
     * Allowing for dot notation access e.g. users.create
     * @return array[]
     */
    public function getAllPermissionsAttribute()
    {
        $permissions_array = [];

        foreach (PermissionInterface::ALL_PERMISSIONS as $group => $permissions) {
            $permissions_array[$group] = [];
            foreach ($permissions as $action => $permission) {
                $permissions_array[$group][$action] = $this->hasPermissionTo($permission);
            }
        }

        return $permissions_array;
    }
}
