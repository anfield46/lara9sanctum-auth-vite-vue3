<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NpkUrea extends Model
{
    use HasFactory;
    protected $table = 'ms_npk_urea';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
