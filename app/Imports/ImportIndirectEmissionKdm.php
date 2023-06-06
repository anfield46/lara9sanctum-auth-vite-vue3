<?php

namespace App\Imports;

use App\Models\IndirectEmissionKdm;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class ImportIndirectEmissionKdm implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row['tahun'] != null) {
            return new IndirectEmissionKdm([
                'tahun' => $row['tahun'],
                'id_pabrik' => $row['id_pabrik'],
                'id_sumber_emisi' => $row['id_sumber_emisi'],
                'consumption_mmbtu' => $row['consumption_mmbtu'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
    }
}
