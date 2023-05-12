<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fugitive extends Model
{
    use HasFactory;
    protected $table = 'ms_fugitive';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
