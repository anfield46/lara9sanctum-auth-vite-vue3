<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerbangan extends Model
{
    use HasFactory;
    protected $table = 'ms_penerbangan';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
