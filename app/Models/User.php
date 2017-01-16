<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ExtendResetPassword as ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'status','parent_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];   

    public function sendPasswordResetNotification($token)
    {        
        $this->notify(new ResetPasswordNotification($token));
    }

    public function getStatusCheckedAtrribute($user, $status){
        if($user->status == $status)
            return true;
        return false;
    }

    public function getRoleNameAttribute($value)
    {
        if($value == 1)
            return 'Super Admin';
        else if($value == 2)
            return 'Manager';
        else if($value == 3)
            return 'Sub Manager';
        else
            return 'User';
    }
}
