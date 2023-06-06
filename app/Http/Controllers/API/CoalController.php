<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coal;
use App\Helpers\Core;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportCoal;

class CoalController extends Controller
{
    /////////////////////////// master data
    public function loadcoal(Request $request, Core $devextreme) //dx grid
    {
        $coal = DB::table('vw_coal as a')
            ->select('a.*');
        $data = $devextreme->data($coal, $request, 'id');
        $datax1 = array();
        foreach ($data['datax'] as $d) {
            $datax1[] = array(
                'id' => Core::encodex($d->id),
                'tahun' => $d->tahun,
                'pabrik' => $d->pabrik,
                'sumber_emisi' => $d->sumber_emisi,
                'tipe_batubara' => $d->tipe_batubara,
                'consumption_mmbtu' => $d->consumption_mmbtu,
                'consumption_tj' => $d->consumption_tj,
                'conversion_factor' => $d->conversion_on_factor,
                'CO2_emissions_factor' => $d->co2_emission_factor,
                'CO2_emissions' => $d->co2_emission,
                'CH4_emissions_factor' => $d->ch4_emission_factor,
                'CH4_emissions' => $d->ch4_emission,
                'N2O_emissions_factor' => $d->n2o_emission_factor,
                'N2O_emissions' => $d->n2o_emission,
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
        Excel::import(new ImportCoal, $request->file('file')->store('files'));
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // add coal
    public function add(Request $request)
    {
        $existing = Coal::where('tahun', $request->tahun)->where('pabrik', $request->pabrik)->where('id_sumber_emisi', $request->id_sumber_emisi)->where('id_tipe_batubara', $request->id_tipe_batubara)->first();
        if ($existing) {
            return response()->json(array('messageinput'   => '0', 'message' => 'Data Gagal ditambahkan, master data sudah tersedia!'));
        }

        $coal = new Coal([
            'tahun' => $request->tahun,
            'id_pabrik' => $request->pabrik,
            'id_sumber_emisi' => $request->sumber_emisi,
            'id_tipe_batubara' => $request->tipe_batubara,
            'consumption_mmbtu' => $request->consumption_mmbtu,
            // 'consumption_tj' => $request->consumption_tj,
            // 'conversion_factor' => $request->conversion_on_factor,
            // 'CO2_emissions_factor' => $request->co2_emissions_factor,
            // 'CO2_emissions' => $request->co2_emissions,
            // 'CH4_emissions_factor' => $request->ch4_emissions_factor,
            // 'CH4_emissions' => $request->ch4_emissions,
            // 'N2O_emissions_factor' => $request->n2o_emissions_factor,
            // 'N2O_emissions' => $request->n2o_emissions,
            // 'CO2eq' => $request->co2eq,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);
        $coal->save();
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // edit coal
    public function edit($id)
    {
        $coal = Coal::find(Core::decodex($id));
        return response()->json($coal);
    }

    // update coal
    public function update($id, Request $request)
    {
        $coal = Coal::find($id);
        $coal->update($request->all());
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // delete coal
    public function delete($id)
    {
        $coal = Coal::find(Core::decodex($id));
        $coal->delete();

        return response()->json('The coal successfully deleted');
    }    
    /////////////////////////// end master data
}
