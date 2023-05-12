<?php

namespace App\Imports;

use App\Models\Ippu;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class ImportIppu implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row['tahun'] != null) {
            return new Ippu([
                'tahun' => $row['tahun'],
                'sumber_emisi' => $row['sumber_emisi'],
                'amount_of_ammonia_produced' => $row['amount_of_ammonia_produced'],
                'fuel_requirement_for_ammonia_production' => $row['fuel_requirement_for_ammonia_production'],
                'carbon_content_of_fuel' => $row['carbon_content_of_fuel'],
                'carbon_oxidation_factor_of_fuel' => $row['carbon_oxidation_factor_of_fuel'],
                'CO2_generated' => $row['co2_generated'],
                'amount_of_urea_produced' => $row['amount_of_urea_produced'],
                'CO2_recovered_for_urea_production' => $row['co2_recovered_for_urea_production'],
                'CO2_recovered_for_urea' => $row['co2_recovered_for_urea'],
                'CO2_emissions' => $row['co2_emissions'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
    }
}
