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
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
    }
}
