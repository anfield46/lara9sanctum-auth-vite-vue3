<?php

namespace App\Imports;

use App\Models\RefrigerantNonPabrik;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class ImportRefrigerantNonPabrik implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row['tahun'] != null) {
            return new RefrigerantNonPabrik([
                'tahun' => $row['tahun'],
                'sumber_emisi' => $row['sumber_emisi'],
                'activity' => $row['activity'],
                'fuel_type' => $row['fuel_type'],
                'unit' => $row['unit'],
                'amount_botol' => $row['amount_botol'],
                'amount_kg_botol' => $row['amount_kg_botol'],
                'amount_kg' => $row['amount_kg'],
                'operating_emission' => $row['operating_emission'],
                'GWP' => $row['gwp'],
                'CO2eq' => $row['co2eq'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
    }
}
