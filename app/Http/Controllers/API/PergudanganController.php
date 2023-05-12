<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pergudangan;
use App\Helpers\Core;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportPergudangan;

class PergudanganController extends Controller
{
    /////////////////////////// master data
    public function loadpergudangan(Request $request, Core $devextreme) //dx grid
    {
        $pergudangan = DB::table('ms_pergudangan as a')
            ->select('a.*');
        $data = $devextreme->data($pergudangan, $request, 'id');
        $datax1 = array();
        foreach ($data['datax'] as $d) {
            $datax1[] = array(
                'id' => Core::encodex($d->id),
                'tahun' => $d->tahun,
                'sumber_emisi' => $d->sumber_emisi,
                'consumption' => $d->consumption,
                'CO2_emission_factor' => $d->CO2_emission_factor,
                'CO2_emission' => $d->CO2_emission,
                'CO2eq' => $d->CO2eq
            );
        }
        return response()->json(
            array(
                // "recordsTotal"    => intval($data['recordsTotal']),
                // "recordsFiltered" => intval($data['recordsFiltered']),
                "totalCount"    => intval($data['recordsFiltered']),
                "data"            => $datax1,
            )
        );
    }

    public function import(Request $request)
    {
        Excel::import(new ImportPergudangan, $request->file('file')->store('files'));
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // add pergudangan
    public function add(Request $request)
    {
        $existing = Pergudangan::where('tahun', $request->tahun)->where('sumber_emisi', $request->sumber_emisi)->first();
        if ($existing) {
            return response()->json(array('messageinput'   => '0', 'message' => 'Data Gagal ditambahkan, master data sudah tersedia!'));
        }

        $pergudangan = new Pergudangan([
            'tahun' => $request->tahun,
            'sumber_emisi' => $request->sumber_emisi,
            'consumption' => $request->consumption,
            'CO2_emission_factor' => $request->co2_emission_factor,
            'CO2_emission' => $request->co2_emission,
            'CO2eq' => $request->co2eq,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);
        $pergudangan->save();
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // edit pergudangan
    public function edit($id)
    {
        $pergudangan = Pergudangan::find(Core::decodex($id));
        return response()->json($pergudangan);
    }

    // update pergudangan
    public function update($id, Request $request)
    {
        $pergudangan = Pergudangan::find($id);
        $pergudangan->update($request->all());
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // delete pergudangan
    public function delete($id)
    {
        $pergudangan = Pergudangan::find(Core::decodex($id));
        $pergudangan->delete();

        return response()->json('The pergudangan successfully deleted');
    }    
    /////////////////////////// end master data
}
