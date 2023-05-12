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
                'pabrik' => $row['pabrik'],
                'sumber_emisi' => $row['sumber_emisi'],
                'consumption_mmbtu' => $row['consumption_mmbtu'],
                'consumption_tj' => $row['consumption_tj'],
                'conversion_factor' => $row['conversion_factor'],
                'CO2_emissions_factor' => $row['co2_emissions_factor'],
                'CO2_emissions' => $row['co2_emissions'],
                'CH4_emissions_factor' => $row['ch4_emissions_factor'],
                'CH4_emissions' => $row['ch4_emissions'],
                'N2O_emissions_factor' => $row['n2o_emissions_factor'],
                'N2O_emissions' => $row['n2o_emissions'],
                'CO2eq' => $row['co2eq'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
    }
}
