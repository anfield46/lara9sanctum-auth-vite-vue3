<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DistribusiKapal;
use App\Helpers\Core;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportDistribusiKapal;

class DistribusiKapalController extends Controller
{
    /////////////////////////// master data
    public function loaddistribusikapal(Request $request, Core $devextreme) //dx grid
    {
        $distribusikapal = DB::table('vw_distribusi_kapal as a')
            ->select('a.*');
        $data = $devextreme->data($distribusikapal, $request, 'id');
        $datax1 = array();
        foreach ($data['datax'] as $d) {
            $datax1[] = array(
                'id' => Core::encodex($d->id),
                'tahun' => $d->tahun,
                'consumption_liter' => $d->consumption_liter,
                'consumption_tj' => $d->consumption_tj,
                'conversion_factor' => $d->conversion_on_factor,
                'CO2_emission_factor' => $d->co2_emission_factor,
                'CO2_emission' => $d->co2_emission,
                'CH4_emission_factor' => $d->ch4_emission_factor,
                'CH4_emission' => $d->ch4_emission,
                'N2O_emission_factor' => $d->n2o_emission_factor,
                'N2O_emission' => $d->n2o_emission,
                'ton_CO2eq' => $d->ton_co2eq,
                'kg_CO2eq' => $d->kg_co2eq, 
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
        Excel::import(new ImportDistribusiKapal, $request->file('file')->store('files'));
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // add distribusikapal
    public function add(Request $request)
    {
        $existing = DistribusiKapal::where('tahun', $request->tahun)->first();
        if ($existing) {
            return response()->json(array('messageinput'   => '0', 'message' => 'Data Gagal ditambahkan, master data sudah tersedia!'));
        }

        $distribusikapal = new DistribusiKapal([
            'tahun' => $request->tahun,
            'consumption_liter' => $request->consumption_liter,
            'consumption_tj' => $request->consumption_tj,
            'conversion_factor' => $request->conversion_factor,
            'CO2_emission_factor' => $request->co2_emission_factor,
            'CO2_emission' => $request->co2_emission,
            'CH4_emission_factor' => $request->ch4_emission_factor,
            'CH4_emission' => $request->ch4_emission,
            'N2O_emission_factor' => $request->n2o_emission_factor,
            'N2O_emission' => $request->n2o_emission,
            'ton_CO2eq' => $request->ton_co2eq,
            'kg_CO2eq' => $request->kg_co2eq,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);
        $distribusikapal->save();
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // edit distribusikapal
    public function edit($id)
    {
        $distribusikapal = DistribusiKapal::find(Core::decodex($id));
        return response()->json($distribusikapal);
    }

    // update distribusikapal
    public function update($id, Request $request)
    {
        $distribusikapal = DistribusiKapal::find($id);
        $distribusikapal->update($request->all());
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // delete distribusikapal
    public function delete($id)
    {
        $distribusikapal = DistribusiKapal::find(Core::decodex($id));
        $distribusikapal->delete();

        return response()->json('The distribusikapal successfully deleted');
    }    
    /////////////////////////// end master data
}
