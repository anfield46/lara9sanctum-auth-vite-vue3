<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefrigerantPabrik extends Model
{
    use HasFactory;
    protected $table = 'ms_refrigerant_pabrik';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
