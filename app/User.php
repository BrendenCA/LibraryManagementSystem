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
        'name', 'email', 'password', 'roleId', 'credit'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role', 'roleId');
    }

    /**
    * @param string|array $roles
    */
    public function authorizeRoles($roles)
    {
        return $this->hasRole($roles) || abort(404);
    }

    /**
    * Check one role
    * @param string $role
    */
    public function hasRole($role)
    {
        return $this->role()->where('title', $role)->exists();
    }

    public function borrow()
    {
        return $this->hasMany('App\Borrow', 'userId');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction', 'userId');
    }

}
