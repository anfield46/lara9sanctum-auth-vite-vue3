<?php

namespace App\Imports;

use App\Models\Pergudangan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class ImportPergudangan implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row['tahun'] != null) {
            return new Pergudangan([
                'tahun' => $row['tahun'],
                'sumber_emisi' => $row['sumber_emisi'],
                'consumption' => $row['consumption'],
                'CO2_emission_factor' => $row['co2_emission_factor'],
                'CO2_emission' => $row['co2_emission'],
                'CO2eq' => $row['co2eq'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
    }
}
