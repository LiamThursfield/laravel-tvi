<?php

namespace App\Models;

use App\Interfaces\PermissionInterface;
use App\Interfaces\RoleInterface;
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
     * Helper to return first + last name.
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get all the roles that this user can select / assign to other users (or themselves).
     * @param bool $force_load
     * @param bool $labelled
     * @return array
     */
    public function getSelectableRoles(bool $force_load = false, bool $labelled = false) : array
    {
        $roles = [];

        if (!$this->relationLoaded('roles') && !$force_load) {
            return $roles;
        }

        foreach ($this->roles as $role) {
            $roles = array_merge($roles, RoleInterface::getSelectableRoles($role->name, $labelled));
        }
        return array_unique($roles);
    }

    /**
     * Return all permissions and whether or not the user has them, in array format
     * Allowing for dot notation access e.g. users.create.
     * @return array[]
     */
    public function getAllPermissionsAttribute() : array
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
