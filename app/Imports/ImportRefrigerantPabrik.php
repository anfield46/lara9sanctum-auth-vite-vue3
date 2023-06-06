<?php

namespace App\Imports;

use App\Models\RefrigerantPabrik;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class ImportRefrigerantPabrik implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row['tahun'] != null) {
            return new RefrigerantPabrik([
                'tahun' => $row['tahun'],
                'id_sumber_emisi' => $row['id_sumber_emisi'],
                'activity' => $row['activity'],
                'fuel_type' => $row['fuel_type'],
                'unit' => $row['unit'],
                'amount' => $row['amount'],
                'operating_emission_factor' => $row['operating_emission_factor'],
                'GWP' => $row['gwp'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
    }
}
