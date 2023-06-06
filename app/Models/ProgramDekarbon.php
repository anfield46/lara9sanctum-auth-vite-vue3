<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramDekarbon extends Model
{
    use HasFactory;
    protected $table = 'tr_program_dekarbon';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
