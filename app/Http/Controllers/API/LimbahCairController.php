<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LimbahCair;
use App\Helpers\Core;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportLimbahCair;

class LimbahCairController extends Controller
{
    /////////////////////////// master data
    public function loadlimbahcair(Request $request, Core $devextreme) //dx grid
    {
        $limbahcair = DB::table('ms_limbah_cair as a')
            ->select('a.*');
        $data = $devextreme->data($limbahcair, $request, 'id');
        $datax1 = array();
        foreach ($data['datax'] as $d) {
            $datax1[] = array(
                'id' => Core::encodex($d->id),
                'industrial_sector' => $d->industrial_sector,
                'type_of_treatment_or_discharge_pathway' => $d->type_of_treatment_or_discharge_pathway,
                'TOWi' => $d->TOWi,
                'Si' => $d->Si,
                'EFi' => $d->EFi,
                'Ri' => $d->Ri,
                'CH4' => $d->CH4,
                'CO2eq' => $d->CO2eq,
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
        Excel::import(new ImportLimbahCair, $request->file('file')->store('files'));
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // add limbahcair
    public function add(Request $request)
    {
        $existing = LimbahCair::where('industrial_sector', $request->industrial_sector)->where('type_of_treatment_or_discharge_pathway', $request->type_of_treatment_or_discharge_pathway)->first();
        if ($existing) {
            return response()->json(array('messageinput'   => '0', 'message' => 'Data Gagal ditambahkan, master data sudah tersedia!'));
        }

        $limbahcair = new LimbahCair([
            'industrial_sector' => $request->industrial_sector,
            'type_of_treatment_or_discharge_pathway' => $request->type_of_treatment_or_discharge_pathway,
            'TOWi' => $request->TOWi,
            'Si' => $request->Si,
            'EFi' => $request->EFi,
            'Ri' => $request->Ri,
            'CH4' => $request->CH4,
            'CO2eq' => $request->CO2eq,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);
        $limbahcair->save();
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // edit limbahcair
    public function edit($id)
    {
        $limbahcair = LimbahCair::find(Core::decodex($id));
        return response()->json($limbahcair);
    }

    // update limbahcair
    public function update($id, Request $request)
    {
        $limbahcair = LimbahCair::find($id);
        $limbahcair->update($request->all());
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // delete limbahcair
    public function delete($id)
    {
        $limbahcair = LimbahCair::find(Core::decodex($id));
        $limbahcair->delete();

        return response()->json('The limbahcair successfully deleted');
    }    
    /////////////////////////// end master data
}
