<?php

namespace App\Imports;

use App\Models\SampahDomestik;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class ImportSampahDomestik implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row['tahun'] != null) {
            return new SampahDomestik([
                'tahun' => $row['tahun'],
                'kategori' => $row['kategori'],
                'annual_amount' => $row['annual_amount'],
                'emission_potential' => $row['emission_potential'],
                'annual_CO2eq' => $row['annual_co2eq'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
    }
}
