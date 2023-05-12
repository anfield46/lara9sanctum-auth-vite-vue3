<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndirectEmissionKdm extends Model
{
    use HasFactory;
    protected $table = 'ms_indirect_emission_kdm';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
