<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function hasTooManyLoginAttempts(Request $request){
        $maxLoginAttempts = 3;
    
        $lockoutTime = 1; // Dalam menit
    
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $maxLoginAttempts, $lockoutTime
        );
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function permissions()
    {
        return $this->hasManyThrough(Permission::class, Role::class);
    }
    public function isSuper()
    {
       if ($this->roles->contains('name', 'admin')) {
            return true;
        }
        return false;
    }
    public function isManager(){
       if ($this->roles->contains('name', 'manager')) {
            return true;
        }
        return false;
    }
    public function isRole($level)
    {
       if ($this->roles->contains('name', $level)) {
            return true;
        }
        return false;
    }
    public function hasRole($role)
    {
        if ($this->isSuper()) {
            return true;
        }
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        return !! $this->roles->intersect($role)->count();
    }
    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->first();
        }
        return $this->roles()->attach($role);
    }
    public function revokeRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->first();
        }
        return $this->roles()->detach($role);
    }
}
