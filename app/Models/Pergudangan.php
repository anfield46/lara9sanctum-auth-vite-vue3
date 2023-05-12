<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pergudangan extends Model
{
    use HasFactory;
    protected $table = 'ms_pergudangan';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
