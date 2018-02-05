<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'roleId'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsTo('App\Role', 'roleId');
    }

    /**
    * @param string|array $roles
    */
    public function authorizeRoles($roles)
    {
        return $this->hasRole($roles) ||
         abort(401, 'This action is unauthorized.');
    }

    /**
    * Check one role
    * @param string $role
    */
    public function hasRole($role)
    {
        return $this->roles()->where('title', $role)->exists();
    }
}
