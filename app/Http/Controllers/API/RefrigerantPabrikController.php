<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RefrigerantPabrik;
use App\Helpers\Core;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportRefrigerantPabrik;

class RefrigerantPabrikController extends Controller
{
    /////////////////////////// master data
    public function loadrefrigerantpabrik(Request $request, Core $devextreme) //dx grid
    {
        $refrigerantpabrik = DB::table('ms_refrigerant_pabrik as a')
            ->select('a.*');
        $data = $devextreme->data($refrigerantpabrik, $request, 'id');
        $datax1 = array();
        foreach ($data['datax'] as $d) {
            $datax1[] = array(
                'id' => Core::encodex($d->id),
                'tahun' => $d->tahun,
                'sumber_emisi' => $d->sumber_emisi,
                'activity' => $d->activity,
                'fuel_type' => $d->fuel_type,
                'unit' => $d->unit,
                'amount' => $d->amount,
                'operating_emission_factor' => $d->operating_emission_factor,
                'GWP' => $d->GWP,
                'ton_CO2eq' => $d->ton_CO2eq
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
        Excel::import(new ImportRefrigerantPabrik, $request->file('file')->store('files'));
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // add refrigerantpabrik
    public function add(Request $request)
    {
        $existing = RefrigerantPabrik::where('tahun', $request->tahun)->where('sumber_emisi', $request->sumber_emisi)->where('fuel_type', $request->fuel_type)->first();
        if ($existing) {
            return response()->json(array('messageinput'   => '0', 'message' => 'Data Gagal ditambahkan, master data sudah tersedia!'));
        }

        $refrigerantpabrik = new RefrigerantPabrik([
            'tahun' => $request->tahun,
            'sumber_emisi' => $request->sumber_emisi,
            'activity' => $request->activity,
            'fuel_type' => $request->fuel_type,
            'unit' => $request->unit,
            'amount' => $request->amount,
            'operating_emission_factor' => $request->operating_emission_factor,
            'GWP' => $request->GWP,
            'ton_CO2eq' => $request->ton_CO2eq,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);
        $refrigerantpabrik->save();
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // edit refrigerantpabrik
    public function edit($id)
    {
        $refrigerantpabrik = RefrigerantPabrik::find(Core::decodex($id));
        return response()->json($refrigerantpabrik);
    }

    // update refrigerantpabrik
    public function update($id, Request $request)
    {
        $refrigerantpabrik = RefrigerantPabrik::find($id);
        $refrigerantpabrik->update($request->all());
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // delete refrigerantpabrik
    public function delete($id)
    {
        $refrigerantpabrik = RefrigerantPabrik::find(Core::decodex($id));
        $refrigerantpabrik->delete();

        return response()->json('The refrigerantpabrik successfully deleted');
    }    
    /////////////////////////// end master data
}