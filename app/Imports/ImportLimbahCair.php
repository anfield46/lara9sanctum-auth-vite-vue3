<?php

namespace App\Imports;

use App\Models\LimbahCair;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class ImportLimbahCair implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row['industrial_sector'] != null) {
            return new LimbahCair([
                'industrial_sector' => $row['industrial_sector'],
                'type_of_treatment_or_discharge_pathway' => $row['type_of_treatment_or_discharge_pathway'],
                'TOWi' => $row['towi'],
                'Si' => $row['si'],
                'EFi' => $row['efi'],
                'Ri' => $row['ri'],
                'CH4' => $row['ch4'],
                'CO2eq' => $row['co2eq'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
    }
}
