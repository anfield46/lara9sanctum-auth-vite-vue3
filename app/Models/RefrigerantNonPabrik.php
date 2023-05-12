<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefrigerantNonPabrik extends Model
{
    use HasFactory;
    protected $table = 'ms_refrigerant_non_pabrik';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
