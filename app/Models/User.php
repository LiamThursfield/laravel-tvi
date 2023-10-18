<?php

namespace App\Models;

use App\Interfaces\PermissionInterface;
use App\Interfaces\RoleInterface;
use App\Models\EDU\Course\Course;
use App\Models\EDU\Course\CourseUser;
use App\Models\EDU\Programme\Programme;
use App\Models\EDU\Programme\ProgrammeUser;
use App\Models\EDU\Purchase\Purchase;
use App\Notifications\Auth\ResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function courses() : HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function programmes() : HasMany
    {
        return $this->hasMany(Programme::class);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function purchasedCourses(): BelongsToMany
    {
        return $this->belongsToMany(
            Course::class,
            CourseUser::class,
        )->withTimestamps();
    }

    public function purchasedProgrammes(): BelongsToMany
    {
        return $this->belongsToMany(
            Programme::class,
            ProgrammeUser::class
        )->withTimestamps();
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
