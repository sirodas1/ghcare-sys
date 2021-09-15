<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalRootUser extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'hospital_root_users';

    protected $fillable = [
        'hospital_id',
        'fullname',
        'email',
        'phone_number',
        'password',
        'profile_pic',
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

}
