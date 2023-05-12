<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GasAlam;
use App\Helpers\Core;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportGasAlam;

class GasAlamController extends Controller
{
    /////////////////////////// master data
    public function loadgasalam(Request $request, Core $devextreme) //dx grid
    {
        $gasalam = DB::table('ms_gas_alam as a')
            ->select('a.*');
        $data = $devextreme->data($gasalam, $request, 'id');
        $datax1 = array();
        foreach ($data['datax'] as $d) {
            $datax1[] = array(
                'id' => Core::encodex($d->id),
                'tahun' => $d->tahun,
                'pabrik' => $d->pabrik,
                'sumber_emisi' => $d->sumber_emisi,
                'consumption_mmbtu' => $d->consumption_mmbtu,
                'consumption_tj' => $d->consumption_tj,
                'conversion_factor' => $d->conversion_factor,
                'CO2_emissions_factor' => $d->CO2_emissions_factor,
                'CO2_emissions' => $d->CO2_emissions,
                'CH4_emissions_factor' => $d->CH4_emissions_factor,
                'CH4_emissions' => $d->CH4_emissions,
                'N2O_emissions_factor' => $d->N2O_emissions_factor,
                'N2O_emissions' => $d->N2O_emissions,
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
        Excel::import(new ImportGasAlam, $request->file('file')->store('files'));
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // add gasalam
    public function add(Request $request)
    {
        $existing = GasAlam::where('tahun', $request->tahun)->where('pabrik', $request->pabrik)->where('sumber_emisi', $request->sumber_emisi)->first();
        if ($existing) {
            return response()->json(array('messageinput'   => '0', 'message' => 'Data Gagal ditambahkan, master data sudah tersedia!'));
        }

        $gasalam = new GasAlam([
            'tahun' => $request->tahun,
            'pabrik' => $request->pabrik,
            'sumber_emisi' => $request->sumber_emisi,
            'consumption_mmbtu' => $request->consumption_mmbtu,
            'consumption_tj' => $request->consumption_tj,
            'conversion_factor' => $request->conversion_on_factor,
            'CO2_emissions_factor' => $request->co2_emissions_factor,
            'CO2_emissions' => $request->co2_emissions,
            'CH4_emissions_factor' => $request->ch4_emissions_factor,
            'CH4_emissions' => $request->ch4_emissions,
            'N2O_emissions_factor' => $request->n2o_emissions_factor,
            'N2O_emissions' => $request->n2o_emissions,
            'CO2eq' => $request->co2eq,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);
        $gasalam->save();
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // edit gasalam
    public function edit($id)
    {
        $gasalam = GasAlam::find(Core::decodex($id));
        return response()->json($gasalam);
    }

    // update gasalam
    public function update($id, Request $request)
    {
        $gasalam = GasAlam::find($id);
        $gasalam->update($request->all());
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // delete gasalam
    public function delete($id)
    {
        $gasalam = GasAlam::find(Core::decodex($id));
        $gasalam->delete();

        return response()->json('The gasalam successfully deleted');
    }    
    /////////////////////////// end master data
}
