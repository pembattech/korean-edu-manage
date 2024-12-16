<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_picture',
        'fullname',
        'dob',
        'marital_status',
        'gender',
        'address',
        'contact_number',
        'email',
        'present_qualification',
        'father_name',
        'mother_name',
        'profession',
        'parents_phone_number',
        'enrollment_date',
    ];

}
