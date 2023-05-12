<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LimbahCair extends Model
{
    use HasFactory;
    protected $table = 'ms_limbah_cair';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
