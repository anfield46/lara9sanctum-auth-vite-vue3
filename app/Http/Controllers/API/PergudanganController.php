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
        $pergudangan = DB::table('vw_pergudangan as a')
            ->select('a.*');
        $data = $devextreme->data($pergudangan, $request, 'id');
        $datax1 = array();
        foreach ($data['datax'] as $d) {
            $datax1[] = array(
                'id' => Core::encodex($d->id),
                'tahun' => $d->tahun,
                'id_sumber_emisi' => $d->id_sumber_emisi,
                'sumber_emisi' => $d->sumber_emisi,
                'consumption' => $d->consumption,
                'assumption_consumption_perm2' => $d->assumption_consumption_perm2,
                'assumption_consumption_per12jam' => $d->assumption_consumption_per12jam,
                'energy_consumption' => $d->energy_consumption,
                'CO2_emission_factor' => $d->co2_emission,
                'CO2_emission' => $d->co2_emission,
                'CO2eq' => $d->co2eq
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
        $existing = Pergudangan::where('tahun', $request->tahun)->where('id_sumber_emisi', $request->id_sumber_emisi)->first();
        if ($existing) {
            return response()->json(array('messageinput'   => '0', 'message' => 'Data Gagal ditambahkan, master data sudah tersedia!'));
        }

        $pergudangan = new Pergudangan([
            'tahun' => $request->tahun,
            'id_sumber_emisi' => $request->sumber_emisi,
            'consumption' => $request->consumption,
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
