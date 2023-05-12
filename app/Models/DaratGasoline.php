<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaratGasoline extends Model
{
    use HasFactory;
    protected $table = 'ms_darat_gasoline';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
