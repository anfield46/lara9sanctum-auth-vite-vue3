<?php

namespace App\Imports;

use App\Models\LimbahCair;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class ImportLimbahCair implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row['industrial_sector'] != null) {
            return new LimbahCair([
                'industrial_sector' => $row['industrial_sector'],
                'EP_A' => $row['ep_a'],
                'EP_B' => $row['ep_b'],
                'Pi' => $row['pi'],
                'CODi' => $row['codi'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
    }
}
