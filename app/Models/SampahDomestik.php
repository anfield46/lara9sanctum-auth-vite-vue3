<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampahDomestik extends Model
{
    use HasFactory;
    protected $table = 'ms_sampah_domestik';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
