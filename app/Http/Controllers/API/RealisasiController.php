<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProgramDekarbon;
use App\Helpers\Core;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportProgramDekarbon;

class RealisasiController extends Controller
{
    /////////////////////////// master data
    public function loadrealisasi(Request $request, Core $devextreme) //dx grid
    {
        $programdekarbon = DB::table('tr_program_dekarbon as a')
                                ->select('a.*', 'b.program_net_zero as program_net_zero_desc')
                                ->join('vl_program_net_zero as b', 'a.id_program_net_zero', 'b.id');
        $data = $devextreme->data($programdekarbon, $request, 'id');
        $datax1 = array();
        foreach ($data['datax'] as $d) {
            $datax1[] = array(
                'id' => Core::encodex($d->id),
                'id_program_net_zero' => $d->id_program_net_zero,
                'program_net_zero' => $d->program_net_zero_desc,
                'tahun' => $d->tahun,
                'realisasi_pengurangan_emisi' => $d->realisasi_pengurangan_emisi,
                'realisasi_penambahan_emisi' => $d->realisasi_penambahan_emisi,
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
        Excel::import(new ImportProgramDekarbon, $request->file('file')->store('files'));
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // add programdekarbon
    public function add(Request $request)
    {
        $existing = ProgramDekarbon::where('tahun', $request->tahun)->where('id_program_net_zero', $request->program_net_zero)->where('id_category', $request->category)->first();
        if ($existing) {
            return response()->json(array('messageinput'   => '0', 'message' => 'Data Gagal ditambahkan, master data sudah tersedia!'));
        }

        $programdekarbon = new ProgramDekarbon([
            'id_category' => $request->category,
            'id_program_net_zero' => $request->program_net_zero,
            'tahun' => $request->tahun,
            'realisasi_pengurangan_emisi' => $request->realisasi_pengurangan_emisi,
            'realisasi_penambahan_emisi' => $request->realisasi_penambahan_emisi,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);
        $programdekarbon->save();
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // edit programdekarbon
    public function edit($id)
    {
        // $programdekarbon = ProgramDekarbon::find(Core::decodex($id));
        $programdekarbon = DB::table('tr_program_dekarbon as a')
                        ->select('a.*', 'b.program_net_zero as program_net_zero_desc')
                        ->join('vl_program_net_zero as b', 'a.id_program_net_zero', 'b.id')
                        ->where('a.id', Core::decodex($id))
                        ->first();
        return response()->json($programdekarbon);
    }

    // update programdekarbon
    public function update($id, Request $request)
    {
        $programdekarbon = ProgramDekarbon::find($id);
        $programdekarbon->update($request->all());
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // delete programdekarbon
    public function delete($id)
    {
        $programdekarbon = ProgramDekarbon::find(Core::decodex($id));
        $programdekarbon->delete();

        return response()->json('The programdekarbon successfully deleted');
    }    
    ///////////////////////////
}
