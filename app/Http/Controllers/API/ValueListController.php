<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use DB;

class ValueListController extends Controller
{
    public function gettahundata()
    {

        $dataxx = [];
        for ($i = 2019; $i < 2070; $i++) {
            $dataxx[] = array(
                'value' => $i,
                'label' => $i,
            );
        }
        return response()->json($dataxx);
    }

    public function getpabrikdata()
    {
        $data = DB::table('vl_pabrik')->get();

        $dataxx = [];
        foreach ($data as $d) {
            $dataxx[] = array(
                'value' => $d->id,
                'label' => $d->pabrik,
            );
        }
        return response()->json($dataxx);
    }

    public function getsumberemisidata()
    {
        $data = DB::table('vl_sumber_emisi')->get();

        $dataxx = [];
        foreach ($data as $d) {
            $dataxx[] = array(
                'value' => $d->id,
                'label' => $d->sumber_emisi,
            );
        }
        return response()->json($dataxx);
    }

    public function getaircoolingsystemdata()
    {
        $data = DB::table('vl_air_cooling_system')->get();

        $activity = [];
        foreach ($data as $d) {
            $activity[] = array(
                'value' => $d->activity,
                'label' => $d->activity,
            );
        }

        $fuel_type = [];
        foreach ($data as $d) {
            $fuel_type[] = array(
                'value' => $d->fuel_type,
                'label' => $d->fuel_type,
            );
        }

        return response()->json(array('activity' => $activity, 'fuel_type' => $fuel_type));
    }

    public function gettipebatubaradata()
    {
        $data = DB::table('vl_tipe_batubara')->get();

        $dataxx = [];
        foreach ($data as $d) {
            $dataxx[] = array(
                'value' => $d->id,
                'label' => $d->tipe_batubara,
            );
        }
        return response()->json($dataxx);
    }

    public function getcategorydata()
    {
        $data = DB::table('vl_category')->get();

        $dataxx = [];
        foreach ($data as $d) {
            $dataxx[] = array(
                'value' => $d->id,
                'label' => $d->category,
            );
        }
        return response()->json($dataxx);
    }

    public function getprogramnetzerodata()
    {
        $data = DB::table('vl_program_net_zero')->get();

        $dataxx = [];
        foreach ($data as $d) {
            $dataxx[] = array(
                'value' => $d->id,
                'label' => $d->program_net_zero,
            );
        }
        return response()->json($dataxx);
    }
}
