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
                'pabrik' => $row['pabrik'],
                'sumber_emisi' => $row['sumber_emisi'],
                'combustion_eficiency' => $row['combustion_eficiency'],
                'conversion_factor' => $row['conversion_factor'],
                'stoichiometric_mass_factor' => $row['stoichiometric_mass_factor'],
                'volume_of_methane' => $row['volume_of_methane'],
                'CO2_emission_gg_year' => $row['co2_emission_gg_year'],
                'CO2_emission_ton_year' => $row['co2_emission_ton_year'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
    }
}
