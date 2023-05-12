<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SampahDomestik;
use App\Helpers\Core;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportSampahDomestik;

class SampahDomestikController extends Controller
{
    /////////////////////////// master data
    public function loadsampahdomestik(Request $request, Core $devextreme) //dx grid
    {
        $sampahdomestik = DB::table('ms_sampah_domestik as a')
            ->select('a.*');
        $data = $devextreme->data($sampahdomestik, $request, 'id');
        $datax1 = array();
        foreach ($data['datax'] as $d) {
            $datax1[] = array(
                'id' => Core::encodex($d->id),
                'tahun' => $d->tahun,
                'kategori' => $d->kategori,
                'annual_amount' => $d->annual_amount,
                'emission_potential' => $d->emission_potential,
                'annual_CO2eq' => $d->annual_CO2eq
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
        Excel::import(new ImportSampahDomestik, $request->file('file')->store('files'));
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // add sampahdomestik
    public function add(Request $request)
    {
        $existing = SampahDomestik::where('tahun', $request->tahun)->where('kategori', $request->kategori)->first();
        if ($existing) {
            return response()->json(array('messageinput'   => '0', 'message' => 'Data Gagal ditambahkan, master data sudah tersedia!'));
        }

        $sampahdomestik = new SampahDomestik([
            'tahun' => $request->tahun,
            'kategori' => $request->kategori,
            'annual_amount' => $request->annual_amount,
            'emission_potential' => $request->emission_potential,
            'annual_CO2eq' => $request->annual_co2eq,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);
        $sampahdomestik->save();
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // edit sampahdomestik
    public function edit($id)
    {
        $sampahdomestik = SampahDomestik::find(Core::decodex($id));
        return response()->json($sampahdomestik);
    }

    // update sampahdomestik
    public function update($id, Request $request)
    {
        $sampahdomestik = SampahDomestik::find($id);
        $sampahdomestik->update($request->all());
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // delete sampahdomestik
    public function delete($id)
    {
        $sampahdomestik = SampahDomestik::find(Core::decodex($id));
        $sampahdomestik->delete();

        return response()->json('The sampahdomestik successfully deleted');
    }    
    /////////////////////////// end master data
}
