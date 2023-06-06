<?php

namespace App\Imports;

use App\Models\Baseline;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class ImportBaseline implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row['tahun'] != null) {
            return new Baseline([
                'emission' => $row['emission'],
                'inventory' => $row['inventory'],
                'sector' => $row['sector'],
                'scope' => $row['scope'],
                'category' => $row['category_desc'],
                'tahun' => $row['tahun'],
                'business_as_usual' => $row['business_as_usual'],
                'pengurangan_emisi_CO2' => $row['pengurangan_emisi_CO2'],
                'penambahan_emisi_CO2' => $row['penambahan_emisi_CO2'],
                'realisasi_pengurangan_emisi_CO2' => $row['realisasi_pengurangan_emisi_CO2'],
                'realisasi_penambahan_emisi_CO2' => $row['realisasi_penambahan_emisi_CO2'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
    }
}
