<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contracts_anniversary_date extends Model
{
    use HasFactory;
    public $table = "contracts_anniversary_dates";

    protected $fillable = [
                           'contract_id',       
                           'anniversary_start_date',
                           'anniversary_end_date',
                           'created_at',
                           'updated_at',
                        ];

    public $timestamps = false;
}
