<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Penerbangan;
use App\Helpers\Core;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportPenerbangan;

class PenerbanganController extends Controller
{
    /////////////////////////// master data
    public function loadpenerbangan(Request $request, Core $devextreme) //dx grid
    {
        $penerbangan = DB::table('ms_penerbangan as a')
            ->select('a.*');
        $data = $devextreme->data($penerbangan, $request, 'id');
        $datax1 = array();
        foreach ($data['datax'] as $d) {
            $datax1[] = array(
                'id' => Core::encodex($d->id),
                'tahun' => $d->tahun,
                'jenis_pesawat' => $d->jenis_pesawat,
                'bahan_bakar' => $d->bahan_bakar,
                'jam_terbang' => $d->jam_terbang,
                'konsumsi_bahan_bakar' => $d->konsumsi_bahan_bakar,
                'energy_consumption_liter' => $d->energy_consumption_liter,
                'conversion_factor' => $d->conversion_factor,
                'energy_consumption_tj' => $d->energy_consumption_tj,
                'CO2_emission_factor' => $d->CO2_emission_factor,
                'CO2_emission' => $d->CO2_emission,
                'CH4_emission_factor' => $d->CH4_emission_factor,
                'CH4_emission' => $d->CH4_emission,
                'N2O_emission_factor' => $d->N2O_emission_factor,
                'N2O_CO2_emission' => $d->N2O_CO2_emission,
                'gg_CO2eq' => $d->gg_CO2eq,
                'ton_CO2eq' => $d->ton_CO2eq,
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
        Excel::import(new ImportPenerbangan, $request->file('file')->store('files'));
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // add penerbangan
    public function add(Request $request)
    {
        $existing = Penerbangan::where('tahun', $request->tahun)->first();
        if ($existing) {
            return response()->json(array('messageinput'   => '0', 'message' => 'Data Gagal ditambahkan, master data sudah tersedia!'));
        }

        $penerbangan = new Penerbangan([
            'tahun' => $request->tahun,
            'jenis_pesawat' => $request->jenis_pesawat,
            'bahan_bakar' => $request->bahan_bakar,
            'jam_terbang' => $request->jam_terbang,
            'konsumsi_bahan_bakar' => $request->konsumsi_bahan_bakar,
            'energy_consumption_liter' => $request->energy_consumption_liter,
            'conversion_factor' => $request->conversion_factor,
            'energy_consumption_tj' => $request->energy_consumption_tj,
            'CO2_emission_factor' => $request->co2_emission_factor,
            'CO2_emission' => $request->co2_emission,
            'CH4_emission_factor' => $request->ch4_emission_factor,
            'CH4_emission' => $request->ch4_emission,
            'N2O_emission_factor' => $request->n2o_emission_factor,
            'N2O_CO2_emission' => $request->n2o_co2_emission,
            'gg_CO2eq' => $request->gg_co2eq,
            'ton_CO2eq' => $request->ton_co2eq,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);
        $penerbangan->save();
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // edit penerbangan
    public function edit($id)
    {
        $penerbangan = Penerbangan::find(Core::decodex($id));
        return response()->json($penerbangan);
    }

    // update penerbangan
    public function update($id, Request $request)
    {
        $penerbangan = Penerbangan::find($id);
        $penerbangan->update($request->all());
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // delete penerbangan
    public function delete($id)
    {
        $penerbangan = Penerbangan::find(Core::decodex($id));
        $penerbangan->delete();

        return response()->json('The penerbangan successfully deleted');
    }    
    /////////////////////////// end master data
}