<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ippu;
use App\Helpers\Core;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportIppu;

class IppuController extends Controller
{
    /////////////////////////// master data
    public function loadippu(Request $request, Core $devextreme) //dx grid
    {
        $ippu = DB::table('ms_ippu as a')
            ->select('a.*');
        $data = $devextreme->data($ippu, $request, 'id');
        $datax1 = array();
        foreach ($data['datax'] as $d) {
            $datax1[] = array(
                'id' => Core::encodex($d->id),
                'tahun' => $d->tahun,
                'sumber_emisi' => $d->sumber_emisi,
                'amount_of_ammonia_produced' => $d->amount_of_ammonia_produced,
                'fuel_requirement_for_ammonia_production' => $d->fuel_requirement_for_ammonia_production,
                'carbon_content_of_fuel' => $d->carbon_content_of_fuel,
                'carbon_oxidation_factor_of_fuel' => $d->carbon_oxidation_factor_of_fuel,
                'CO2_generated' => $d->CO2_generated,
                'amount_of_urea_produced' => $d->amount_of_urea_produced,
                'CO2_recovered_for_urea_production' => $d->CO2_recovered_for_urea_production,
                'CO2_recovered_for_urea' => $d->CO2_recovered_for_urea,
                'CO2_emissions' => $d->CO2_emissions
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
        Excel::import(new ImportIppu, $request->file('file')->store('files'));
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // add ippu
    public function add(Request $request)
    {
        $existing = Ippu::where('tahun', $request->tahun)->where('sumber_emisi', $request->sumber_emisi)->first();
        if ($existing) {
            return response()->json(array('messageinput'   => '0', 'message' => 'Data Gagal ditambahkan, master data sudah tersedia!'));
        }

        $ippu = new Ippu([
            'tahun' => $request->tahun,
            'sumber_emisi' => $request->sumber_emisi,
            'amount_of_ammonia_produced' => $request->amount_of_ammonia_produced,
            'fuel_requirement_for_ammonia_production' => $request->fuel_requirement_for_ammonia_production,
            'carbon_content_of_fuel' => $request->carbon_content_of_fuel,
            'carbon_oxidation_factor_of_fuel' => $request->carbon_oxidation_factor_of_fuel,
            'CO2_generated' => $request->CO2_generated,
            'amount_of_urea_produced' => $request->amount_of_urea_produced,
            'CO2_recovered_for_urea_production' => $request->CO2_recovered_for_urea_production,
            'CO2_recovered_for_urea' => $request->CO2_recovered_for_urea,
            'CO2_emissions' => $request->CO2_emissions,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);
        $ippu->save();
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // edit ippu
    public function edit($id)
    {
        $ippu = Ippu::find(Core::decodex($id));
        return response()->json($ippu);
    }

    // update ippu
    public function update($id, Request $request)
    {
        $ippu = Ippu::find($id);
        $ippu->update($request->all());
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // delete ippu
    public function delete($id)
    {
        $ippu = Ippu::find(Core::decodex($id));
        $ippu->delete();

        return response()->json('The ippu successfully deleted');
    }    
    /////////////////////////// end master data
}
