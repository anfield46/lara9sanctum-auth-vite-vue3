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
                'id_pabrik' => $row['id_pabrik'],
                'gas_fuel_needs' => $row['gas_fuel_needs'],
                'gas_process_needs' => $row['gas_process_needs'],
                'amount_of_ammonia_produced' => $row['amount_of_ammonia_produced'],
                'carbon_content_of_fuel' => $row['carbon_content_of_fuel'],
                'carbon_oxidation_factor_of_fuel' => $row['carbon_oxidation_factor_of_fuel'],
                'amount_of_urea_produced' => $row['amount_of_urea_produced'],
                'CO2_recovered_for_urea' => $row['co2_recovered_for_urea'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
    }
}
