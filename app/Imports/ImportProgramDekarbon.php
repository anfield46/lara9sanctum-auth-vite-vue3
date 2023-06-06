<?php

namespace App\Imports;

use App\Models\ProgramDekarbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class ImportProgramDekarbon implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row['tahun'] != null) {
            return new ProgramDekarbon([
                'tahun' => $row['tahun'],
                'id_category' => $row['id_kategori'],
                'id_program_net_zero' => $row['id_program'],
                'rencana_penambahan_emisi' => $row['penambahan'],
                'rencana_pengurangan_emisi' => $row['pengurangan'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
    }
}
