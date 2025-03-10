<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BirthCertificate extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'name_hi',
        'gender',
        'dob',
        'mobile',
        'fathername',
        'fathername_hi',
        'fathername_adhar',
        'mothername',
        'mothername_hi',
        'mothername_adhar',
        'village',
        'village_hi',
        'post',
        'post_hi',
        'police_station',
        'police_station_hi',
        'distric',
        'distric_hi',
        'state',
        'pincode',
        'status',
    ];
}
