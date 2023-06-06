<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RefrigerantNonPabrik;
use App\Helpers\Core;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportRefrigerantNonPabrik;

class RefrigerantNonPabrikController extends Controller
{
    /////////////////////////// master data
    public function loadrefrigerantnonpabrik(Request $request, Core $devextreme) //dx grid
    {
        $refrigerantnonpabrik = DB::table('vw_refrigerant_non_pabrik as a')
            ->select('a.*');
        $data = $devextreme->data($refrigerantnonpabrik, $request, 'id');
        $datax1 = array();
        foreach ($data['datax'] as $d) {
            $datax1[] = array(
                'id' => Core::encodex($d->id),
                'tahun' => $d->tahun,
                'id_sumber_emisi' => $d->id_sumber_emisi,
                'sumber_emisi' => $d->sumber_emisi,
                'activity' => $d->activity,
                'fuel_type' => $d->fuel_type,
                'unit' => $d->unit,
                'amount' => $d->amount,
                'operating_emission' => $d->operating_emission_factor,
                'GWP' => $d->GWP,
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
        Excel::import(new ImportRefrigerantNonPabrik, $request->file('file')->store('files'));
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // add refrigerantnonpabrik
    public function add(Request $request)
    {
        $existing = RefrigerantNonPabrik::where('tahun', $request->tahun)->where('id_sumber_emisi', $request->id_sumber_emisi)->where('fuel_type', $request->fuel_type)->first();
        if ($existing) {
            return response()->json(array('messageinput'   => '0', 'message' => 'Data Gagal ditambahkan, master data sudah tersedia!'));
        }

        $getvalue = DB::table('vl_air_cooling_system as a')
        ->where('activity', $request->activity)
            ->where('fuel_type', $request->fuel_type)
            ->first();


        if (is_null($getvalue)) {
            return response()->json(array('messageinput'   => '0', 'message' => 'Data Gagal ditambahkan, data value belum tersedia'));
        }

        $refrigerantnonpabrik = new RefrigerantNonPabrik([
            'tahun' => $request->tahun,
            'id_sumber_emisi' => $request->sumber_emisi,
            'activity' => $request->activity,
            'fuel_type' => $request->fuel_type,
            'unit' => $getvalue->unit,
            'amount' => $request->amount,
            'operating_emission_factor' => $getvalue->operating_emission,
            'GWP' => $getvalue->gwp,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);
        $refrigerantnonpabrik->save();
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // edit refrigerantnonpabrik
    public function edit($id)
    {
        $refrigerantnonpabrik = RefrigerantNonPabrik::find(Core::decodex($id));
        return response()->json($refrigerantnonpabrik);
    }

    // update refrigerantnonpabrik
    public function update($id, Request $request)
    {
        $refrigerantnonpabrik = RefrigerantNonPabrik::find($id);

        $getvalue = DB::table('vl_air_cooling_system as a')
            ->where('activity', $request->activity)
            ->where('fuel_type', $request->fuel_type)
            ->first();

        $request['unit'] = $getvalue->unit;
        $request['operating_emission_factor'] = $getvalue->operating_emission;
        $request['GWP'] = $getvalue->gwp;

        $refrigerantnonpabrik->update($request->all());
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // delete refrigerantnonpabrik
    public function delete($id)
    {
        $refrigerantnonpabrik = RefrigerantNonPabrik::find(Core::decodex($id));
        $refrigerantnonpabrik->delete();

        return response()->json('The refrigerantnonpabrik successfully deleted');
    }    
    /////////////////////////// end master data
}
