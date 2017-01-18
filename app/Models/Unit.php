<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'units';
    protected $fillable = ['code','address','city','postal_code','building','phone','fax','third_party','third_party_phone','third_party_fax','third_party_email','unit_type','floor','bedroom','bedroom_study','bathroom','bathroom_half','sqft','lockbox_code','lockbox_notes','status'];
}
