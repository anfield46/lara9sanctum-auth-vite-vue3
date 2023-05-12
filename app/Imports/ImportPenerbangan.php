<?php

namespace App\Imports;

use App\Models\Penerbangan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class ImportPenerbangan implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row['tahun'] != null) {
            return new Penerbangan([
                'tahun' => $row['tahun'],
                'jenis_pesawat' => $row['jenis_pesawat'],
                'bahan_bakar' => $row['bahan_bakar'],
                'jam_terbang' => $row['jam_terbang'],
                'konsumsi_bahan_bakar' => $row['konsumsi_bahan_bakar'],
                'energy_consumption_liter' => $row['energy_consumption_liter'],
                'conversion_factor' => $row['conversion_factor'],
                'energy_consumption_tj' => $row['energy_consumption_tj'],
                'CO2_emission_factor' => $row['co2_emission_factor'],
                'CO2_emission' => $row['co2_emission'],
                'CH4_emission_factor' => $row['ch4_emission_factor'],
                'CH4_emission' => $row['ch4_emission'],
                'N2O_emission_factor' => $row['n2o_emission_factor'],
                'N2O_CO2_emission' => $row['n2o_co2_emission'],
                'gg_CO2eq' => $row['gg_co2eq'],
                'ton_CO2eq' => $row['ton_co2eq'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
    }
}
