<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GasAlam extends Model
{
    use HasFactory;
    protected $table = 'ms_gas_alam';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
