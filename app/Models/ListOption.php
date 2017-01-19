<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListOption extends Model
{
   	public $timestamps = false;
    protected $table = 'list_options';
    protected $fillable = ['name','key','parent_id','default'];
}
