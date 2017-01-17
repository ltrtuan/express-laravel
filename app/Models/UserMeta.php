<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    public $timestamps = false;
    protected $table = 'usermeta';
    protected $fillable = ['user_id','meta_key','meta_value'];
}
