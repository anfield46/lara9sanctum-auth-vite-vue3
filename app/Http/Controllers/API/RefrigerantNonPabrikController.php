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
        $refrigerantnonpabrik = DB::table('ms_refrigerant_non_pabrik as a')
            ->select('a.*');
        $data = $devextreme->data($refrigerantnonpabrik, $request, 'id');
        $datax1 = array();
        foreach ($data['datax'] as $d) {
            $datax1[] = array(
                'id' => Core::encodex($d->id),
                'tahun' => $d->tahun,
                'sumber_emisi' => $d->sumber_emisi,
                'activity' => $d->activity,
                'fuel_type' => $d->fuel_type,
                'unit' => $d->unit,
                'amount_botol' => $d->amount_botol,
                'amount_kg_botol' => $d->amount_kg_botol,
                'amount_kg' => $d->amount_kg,
                'operating_emission' => $d->operating_emission,
                'GWP' => $d->GWP,
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
        Excel::import(new ImportRefrigerantNonPabrik, $request->file('file')->store('files'));
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // add refrigerantnonpabrik
    public function add(Request $request)
    {
        $existing = RefrigerantNonPabrik::where('tahun', $request->tahun)->where('sumber_emisi', $request->sumber_emisi)->where('fuel_type', $request->fuel_type)->first();
        if ($existing) {
            return response()->json(array('messageinput'   => '0', 'message' => 'Data Gagal ditambahkan, master data sudah tersedia!'));
        }

        $refrigerantnonpabrik = new RefrigerantNonPabrik([
            'tahun' => $request->tahun,
            'sumber_emisi' => $request->sumber_emisi,
            'activity' => $request->activity,
            'fuel_type' => $request->fuel_type,
            'unit' => $request->unit,
            'amount_botol' => $request->amount_botol,
            'amount_kg_botol' => $request->amount_kg_botol,
            'amount_kg' => $request->amount_kg,
            'operating_emission' => $request->operating_emission,
            'GWP' => $request->GWP,
            'CO2eq' => $request->CO2eq,
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
