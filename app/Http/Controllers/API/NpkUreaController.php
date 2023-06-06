<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NpkUrea;
use App\Helpers\Core;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportNpkUrea;

class NpkUreaController extends Controller
{
    /////////////////////////// master data
    public function loadnpkurea(Request $request, Core $devextreme) //dx grid
    {
        $npkurea = DB::table('vw_npk_urea as a')
            ->select('a.*');
        $data = $devextreme->data($npkurea, $request, 'id');
        $datax1 = array();
        foreach ($data['datax'] as $d) {
            $datax1[] = array(
                'id' => Core::encodex($d->id),
                'tahun' => $d->tahun,
                'jenis' => $d->jenis,
                'annual_amount' => $d->annual_amount,
                'emission_factor' => $d->co2_emission_factor,
                'annual_CO2eq' => $d->annual_co2eq
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
        Excel::import(new ImportNpkUrea, $request->file('file')->store('files'));
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // add npkurea
    public function add(Request $request)
    {
        $existing = NpkUrea::where('tahun', $request->tahun)->where('jenis', $request->jenis)->first();
        if ($existing) {
            return response()->json(array('messageinput'   => '0', 'message' => 'Data Gagal ditambahkan, master data sudah tersedia!'));
        }

        $npkurea = new NpkUrea([
            'tahun' => $request->tahun,
            'jenis' => $request->jenis,
            'annual_amount' => $request->annual_amount,
            'emission_factor' => $request->emission_factor,
            'annual_CO2eq' => $request->annual_co2eq,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);
        $npkurea->save();
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // edit npkurea
    public function edit($id)
    {
        $npkurea = NpkUrea::find(Core::decodex($id));
        return response()->json($npkurea);
    }

    // update npkurea
    public function update($id, Request $request)
    {
        $npkurea = NpkUrea::find($id);
        $npkurea->update($request->all());
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // delete npkurea
    public function delete($id)
    {
        $npkurea = NpkUrea::find(Core::decodex($id));
        $npkurea->delete();

        return response()->json('The npkurea successfully deleted');
    }    
    /////////////////////////// end master data
}
