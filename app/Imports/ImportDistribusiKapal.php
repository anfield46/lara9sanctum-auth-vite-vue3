<?php

namespace App\Imports;

use App\Models\DistribusiKapal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class ImportDistribusiKapal implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row['tahun'] != null) {
            return new DistribusiKapal([
                'tahun' => $row['tahun'],
                'consumption_liter' => $row['consumption_liter'],
                'conversion_factor' => $row['conversion_factor'],
                'consumption_tj' => $row['consumption_tj'],
                'CO2_emission_factor' => $row['co2_emission_factor'],
                'CO2_emission' => $row['co2_emission'],
                'CH4_emission_factor' => $row['ch4_emission_factor'],
                'CH4_emission' => $row['ch4_emission'],
                'N2O_emission_factor' => $row['n2o_emission_factor'],
                'N2O_emission' => $row['n2o_emission'],
                'ton_CO2eq' => $row['ton_co2eq'],
                'kg_CO2eq' => $row['kg_co2eq'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
    }
}
