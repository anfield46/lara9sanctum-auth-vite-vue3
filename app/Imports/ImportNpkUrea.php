<?php

namespace App\Imports;

use App\Models\NpkUrea;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class ImportNpkUrea implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row['tahun'] != null) {
            return new NpkUrea([
                'tahun' => $row['tahun'],
                'jenis' => $row['jenis'],
                'annual_amount' => $row['annual_amount'],
                // 'emission_factor' => $row['emission_factor'],
                // 'annual_CO2eq' => $row['annual_co2eq'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
    }
}
