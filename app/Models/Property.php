<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{  
    protected $table = 'properties';
    protected $fillable = ['name','address','address_2','city','postal_code','main_phone','main_fax','e_phone','office_hours','website','main_email','management','building_type','property_type','category','status'];
}
