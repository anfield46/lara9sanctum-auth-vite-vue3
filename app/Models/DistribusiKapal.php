<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribusiKapal extends Model
{
    use HasFactory;
    protected $table = 'ms_distribusi_kapal';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
