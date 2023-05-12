<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fugitive;
use App\Helpers\Core;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportFugitive;

class FugitiveController extends Controller
{
    /////////////////////////// master data
    public function loadfugitive(Request $request, Core $devextreme) //dx grid
    {
        $fugitive = DB::table('ms_fugitive as a')
            ->select('a.*');
        $data = $devextreme->data($fugitive, $request, 'id');
        $datax1 = array();
        foreach ($data['datax'] as $d) {
            $datax1[] = array(
                'id' => Core::encodex($d->id),
                'tahun' => $d->tahun,
                'pabrik' => $d->pabrik,
                'sumber_emisi' => $d->sumber_emisi,
                'combustion_eficiency' => $d->combustion_eficiency,
                'conversion_factor' => $d->conversion_factor,
                'stoichiometric_mass_factor' => $d->stoichiometric_mass_factor,
                'volume_of_methane' => $d->volume_of_methane,
                'CO2_emission_gg_year' => $d->CO2_emission_gg_year,
                'CO2_emission_ton_year' => $d->CO2_emission_ton_year
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
        Excel::import(new ImportFugitive, $request->file('file')->store('files'));
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // add fugitive
    public function add(Request $request)
    {
        $existing = Fugitive::where('tahun', $request->tahun)->where('sumber_emisi', $request->sumber_emisi)->first();
        if ($existing) {
            return response()->json(array('messageinput'   => '0', 'message' => 'Data Gagal ditambahkan, master data sudah tersedia!'));
        }

        $fugitive = new Fugitive([
            'tahun' => $request->tahun,
            'pabrik' => $request->pabrik,
            'sumber_emisi' => $request->sumber_emisi,
            'combustion_eficiency' => $request->combustion_eficiency,
            'conversion_factor' => $request->conversion_factor,
            'stoichiometric_mass_factor' => $request->stoichiometric_mass_factor,
            'volume_of_methane' => $request->volume_of_methane,
            'CO2_emission_gg_year' => $request->CO2_emission_gg_year,
            'CO2_emission_ton_year' => $request->CO2_emission_ton_year,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);
        $fugitive->save();
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // edit fugitive
    public function edit($id)
    {
        $fugitive = Fugitive::find(Core::decodex($id));
        return response()->json($fugitive);
    }

    // update fugitive
    public function update($id, Request $request)
    {
        $fugitive = Fugitive::find($id);
        $fugitive->update($request->all());
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // delete fugitive
    public function delete($id)
    {
        $fugitive = Fugitive::find(Core::decodex($id));
        $fugitive->delete();

        return response()->json('The fugitive successfully deleted');
    }    
    /////////////////////////// end master data
}
