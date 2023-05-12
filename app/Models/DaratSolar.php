<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaratSolar extends Model
{
    use HasFactory;
    protected $table = 'ms_darat_solar';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
