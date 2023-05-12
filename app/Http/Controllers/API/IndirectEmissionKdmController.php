<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IndirectEmissionKdm;
use App\Helpers\Core;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportIndirectEmissionKdm;

class IndirectEmissionKdmController extends Controller
{
    /////////////////////////// master data
    public function loadindirectemissionkdm(Request $request, Core $devextreme) //dx grid
    {
        $indirectemissionkdm = DB::table('ms_indirect_emission_kdm as a')
            ->select('a.*');
        $data = $devextreme->data($indirectemissionkdm, $request, 'id');
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
        Excel::import(new ImportIndirectEmissionKdm, $request->file('file')->store('files'));
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // add indirectemissionkdm
    public function add(Request $request)
    {
        $existing = IndirectEmissionKdm::where('tahun', $request->tahun)->where('pabrik', $request->pabrik)->where('sumber_emisi', $request->sumber_emisi)->first();
        if ($existing) {
            return response()->json(array('messageinput'   => '0', 'message' => 'Data Gagal ditambahkan, master data sudah tersedia!'));
        }

        $indirectemissionkdm = new IndirectEmissionKdm([
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
        $indirectemissionkdm->save();
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // edit indirectemissionkdm
    public function edit($id)
    {
        $indirectemissionkdm = IndirectEmissionKdm::find(Core::decodex($id));
        return response()->json($indirectemissionkdm);
    }

    // update indirectemissionkdm
    public function update($id, Request $request)
    {
        $indirectemissionkdm = IndirectEmissionKdm::find($id);
        $indirectemissionkdm->update($request->all());
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // delete indirectemissionkdm
    public function delete($id)
    {
        $indirectemissionkdm = IndirectEmissionKdm::find(Core::decodex($id));
        $indirectemissionkdm->delete();

        return response()->json('The indirectemissionkdm successfully deleted');
    }    
    /////////////////////////// end master data
}
