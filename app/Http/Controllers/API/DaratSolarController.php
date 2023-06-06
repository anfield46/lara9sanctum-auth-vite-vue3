<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DaratSolar;
use App\Helpers\Core;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportDaratSolar;

class DaratSolarController extends Controller
{
    /////////////////////////// master data
    public function loaddaratsolar(Request $request, Core $devextreme) //dx grid
    {
        $daratsolar = DB::table('vw_darat_solar as a')
            ->select('a.*');
        $data = $devextreme->data($daratsolar, $request, 'id');
        $datax1 = array();
        foreach ($data['datax'] as $d) {
            $datax1[] = array(
                'id' => Core::encodex($d->id),
                'tahun' => $d->tahun,
                'energy_consumption_liter' => $d->energy_consumption,
                'biodiesel' => $d->biodiesel,
                'energy_consumption_tj' => $d->consumption_tj,
                'conversion_factor' => $d->conversion_on_factor,
                'CO2_emission_factor' => $d->co2_emission_factor,
                'CO2_emission' => $d->co2_emission,
                'CH4_emission_factor' => $d->ch4_emission_factor,
                'CH4_emission' => $d->ch4_emission,
                'N2O_emission_factor' => $d->n2o_emission_factor,
                'N2O_CO2_emission' => $d->n2o_emission,
                'ton_CO2eq' => $d->co2eq
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
        Excel::import(new ImportDaratSolar, $request->file('file')->store('files'));
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // add daratsolar
    public function add(Request $request)
    {
        $existing = DaratSolar::where('tahun', $request->tahun)->first();
        if ($existing) {
            return response()->json(array('messageinput'   => '0', 'message' => 'Data Gagal ditambahkan, master data sudah tersedia!'));
        }

        $daratsolar = new DaratSolar([
            'tahun' => $request->tahun,
            'energy_consumption_liter' => $request->energy_consumption_liter,
            'biodiesel' => $request->biodiesel,
            // 'energy_consumption_tj' => $request->energy_consumption_tj,
            // 'conversion_factor' => $request->conversion_factor,
            // 'CO2_emission_factor' => $request->co2_emissions_factor,
            // 'CO2_emission' => $request->co2_emissions,
            // 'CH4_emission_factor' => $request->ch4_emissions_factor,
            // 'CH4_emission' => $request->ch4_emissions,
            // 'N2O_emission_factor' => $request->n2o_emissions_factor,
            // 'N2O_CO2_emission' => $request->n2o_emissions,
            // 'ton_CO2eq' => $request->ton_co2eq,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);
        $daratsolar->save();
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // edit daratsolar
    public function edit($id)
    {
        $daratsolar = DaratSolar::find(Core::decodex($id));
        return response()->json($daratsolar);
    }

    // update daratsolar
    public function update($id, Request $request)
    {
        $daratsolar = DaratSolar::find($id);
        $daratsolar->update($request->all());
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // delete daratsolar
    public function delete($id)
    {
        $daratsolar = DaratSolar::find(Core::decodex($id));
        $daratsolar->delete();

        return response()->json('The daratsolar successfully deleted');
    }    
    /////////////////////////// end master data
}
