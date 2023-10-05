<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Useranniversydate extends Model
{
    use HasFactory;
    public $table = "developerannversydates";

    protected $fillable = [
                           'user_id', 
                           'developer_id',
                           'anniversary_start_date',
                           'anniversary_end_date',
                           'created_at',
                           'updated_at',
                        ];

    public $timestamps = false;
}
