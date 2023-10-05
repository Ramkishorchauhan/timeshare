<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRegister extends Model
{
    use HasFactory;
    public $table = "developer_registration";

    protected $fillable = ['id',
                           'developer_id', 
                           'points_enroll',
                           'points_type',
                           'ownership_level',
                           'user_id',
                           'no_of_points_owned',
                           'created_at',
                           'updated_at'
                        ];

    public $timestamps = false;
}
