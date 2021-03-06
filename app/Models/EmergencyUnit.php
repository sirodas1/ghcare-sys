<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyUnit extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'emergency_units';

    protected $fillable = [
        'affiliate_institution',
        'ems_card_number',
        'firstname',
        'lastname',
        'othernames',
        'gender',
        'age',
        'email',
        'phone_number',
        'password',
        'profile_pic',
        'region',
        'district',
        'town',
        'landmark',
        'residential_address',
        'on_duty',
    ];

    
}
