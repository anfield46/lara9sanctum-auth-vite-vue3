<?php

namespace App\Imports;

use App\Models\Fugitive;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class ImportFugitive implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row['tahun'] != null) {
            return new Fugitive([
                'tahun' => $row['tahun'],
                'id_pabrik' => $row['id_pabrik'],
                'id_sumber_emisi' => $row['id_sumber_emisi'],
                'perfect_burn' => $row['perfect_burn'],
                'volume_of_methane' => $row['volume_of_methane'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
    }
}
