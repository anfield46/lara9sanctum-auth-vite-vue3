<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Baseline;
use App\Helpers\Core;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportBaseline;

class BaselineController extends Controller
{
    /////////////////////////// master data
    public function baseline() //dx grid
    {
        $category = DB::table('vl_category')->get();

        $datax = [];
        $chart_bau = [];
        $current_bau = [];
        $current_rencana = [];
        $current_realisasi = [];
        // loop 2019 sd 2030
        $sum_gas_alam = 0;
        $sum_coal = 0;
        $sum_ippu = 0;
        $sum_limbah_cair = 0;
        $sum_gas_alam_npk = 0;
        $sum_fugitive = 0;
        $sum_refrigerant_pabrik = 0;
        $sum_refrigerant_non_pabrik = 0;
        $sum_darat_gasoline = 0;
        $sum_darat_solar = 0;
        $sum_indirect_emission_kdm = 0;
        $sum_penerbangan = 0;
        $sum_pergudangan = 0;
        $sum_distribusi_kapal = 0;
        $sum_use_urea = 0;
        $sum_use_npk = 0;
        $sum_sampah_domestik = 0;
        for ($tahun=2019; $tahun < 2061; $tahun++) {
            // foreach ($category as $value) {
                DB::connection()->enableQueryLog();
                $gas_alam = DB::table('vw_gas_alam as a')
                                ->select('a.co2eq')
                                ->leftjoin('map_baseline as b','a.id_pabrik','=','b.id_pabrik')
                                ->where('b.master', 'gas_alam')
                                ->where('a.tahun', $tahun)
                                ->where('b.id_category', 1)
                                ->groupby('a.id_pabrik')
                                ->groupby('a.sumber_emisi')
                                ->get();
                
                $coal = DB::table('vw_coal as a')
                                ->select('a.co2eq')
                                ->leftjoin('map_baseline as b','a.id_pabrik','=','b.id_pabrik')
                                ->where('b.master', 'coal')
                                ->where('a.tahun', $tahun)
                                ->where('b.id_category', 2)
                                ->groupby('a.id_pabrik')
                                ->groupby('a.sumber_emisi')
                                ->groupby('a.tipe_batubara')
                                ->get();

                $ippu = DB::table('vw_ippu as a')
                                ->select('a.co2_emissions')
                                ->where('a.tahun', $tahun)
                                ->get();

                $limbah_cair = DB::table('vw_limbah_cair as a')
                                ->select('a.ton_CO2eq')
                                ->where('a.tahun', $tahun)
                                ->get();

                $gas_alam_npk = DB::table('vw_gas_alam as a')
                                ->select('a.co2eq')
                                ->leftjoin('map_baseline as b','a.id_pabrik','=','b.id_pabrik')
                                ->where('b.master', 'gas_alam')
                                ->where('a.tahun', $tahun)
                                ->where('b.id_category', 5)
                                ->groupby('a.id_pabrik')
                                ->groupby('a.sumber_emisi')
                                ->get();

                $fugitive = DB::table('vw_fugitive as a')
                                ->select('a.co2_emission_ton_year')
                                ->where('a.master', 'fugitive')
                                ->where('a.tahun', $tahun)
                                ->get();

                $refrigerant_pabrik = DB::table('vw_refrigerant_pabrik as a')
                                ->select('a.co2eq')
                                ->where('a.master', 'refrigerant_pabrik')
                                ->where('a.tahun', $tahun)
                                ->get();

                $refrigerant_non_pabrik = DB::table('vw_refrigerant_non_pabrik as a')
                                ->select('a.co2eq')
                                ->where('a.master', 'refrigerant_non_pabrik')
                                ->where('a.tahun', $tahun)
                                ->get();

                $darat_gasoline = DB::table('vw_darat_gasoline as a')
                                ->select('a.co2eq')
                                ->where('a.master', 'darat_gasoline')
                                ->where('a.tahun', $tahun)
                                ->get();

                $darat_solar = DB::table('vw_darat_solar as a')
                                ->select('a.co2eq')
                                ->where('a.master', 'darat_solar')
                                ->where('a.tahun', $tahun)
                                ->get();

                ////////////////////
                $fasilitas_penunjang_gas_alam = DB::table('vw_gas_alam as a')
                                ->select('a.co2eq')
                                ->leftjoin('map_baseline as b','a.id_pabrik','=','b.id_pabrik')
                                ->where('b.master', 'gas_alam')
                                ->where('a.tahun', $tahun)
                                ->where('b.id_category', 11)
                                ->groupby('a.id_pabrik')
                                ->groupby('a.sumber_emisi')
                                ->get();

                $fasilitas_penunjang_coal = DB::table('vw_coal as a')
                                ->select('a.co2eq')
                                ->leftjoin('map_baseline as b','a.id_pabrik','=','b.id_pabrik')
                                ->where('b.master', 'coal')
                                ->where('a.tahun', $tahun)
                                ->where('b.id_category', 11)
                                ->groupby('a.id_pabrik')
                                ->groupby('a.sumber_emisi')
                                ->groupby('a.tipe_batubara')
                                ->get();
                ////////////////////
                ////////////////////
                $jvc_gas_alam = DB::table('vw_gas_alam as a')
                                ->select('a.co2eq')
                                ->leftjoin('map_baseline as b', 'a.id_pabrik', '=', 'b.id_pabrik')
                                ->where('b.master', 'gas_alam')
                                ->where('a.tahun', $tahun)
                                ->where('b.id_category', 12)
                                ->groupby('a.id_pabrik')
                                ->groupby('a.sumber_emisi')
                                ->get();

                $jvc_coal = DB::table('vw_coal as a')
                                ->select('a.co2eq')
                                ->leftjoin('map_baseline as b', 'a.id_pabrik', '=', 'b.id_pabrik')
                                ->where('b.master', 'coal')
                                ->where('a.tahun', $tahun)
                                ->where('b.id_category', 12)
                                ->groupby('a.id_pabrik')
                                ->groupby('a.sumber_emisi')
                                ->groupby('a.tipe_batubara')
                                ->get();
                ////////////////////

                $indirect_emission_kdm = DB::table('vw_indirect_emission_kdm as a')
                                ->select('a.co2eq')
                                ->where('a.master', 'indirect_emission_kdm')
                                ->where('a.tahun', $tahun)
                                ->get();

                $penerbangan = DB::table('vw_penerbangan as a')
                                ->select('a.ton_co2eq')
                                ->where('a.master', 'penerbangan')
                                ->where('a.tahun', $tahun)
                                ->get();

                $pergudangan = DB::table('vw_pergudangan as a')
                                ->select('a.co2eq')
                                ->where('a.master', 'pergudangan')
                                ->where('a.tahun', $tahun)
                                ->get();

                $distribusi_kapal = DB::table('vw_distribusi_kapal as a')
                                ->select('a.ton_co2eq')
                                ->where('a.master', 'distribusi_kapal')
                                ->where('a.tahun', $tahun)
                                ->get();

                $use_urea = DB::table('vw_npk_urea as a')
                                ->select('a.annual_co2eq')
                                ->where('a.master', 'npk_urea')
                                ->where('a.tahun', $tahun)
                                ->where('a.jenis', 'urea')
                                ->get();

                $use_npk = DB::table('vw_npk_urea as a')
                                ->select('a.annual_co2eq')
                                ->where('a.master', 'npk_urea')
                                ->where('a.tahun', $tahun)
                                ->where('a.jenis', 'npk')
                                ->get();

                $sampah_domestik = DB::table('ms_sampah_domestik as a')
                                ->select('a.annual_CO2eq')
                                ->where('a.tahun', $tahun)
                                ->get();

                $sum_gas_alam = $gas_alam->sum('co2eq');
                $sum_coal = $coal->sum('co2eq');
                $sum_ippu = $ippu->sum('co2_emissions');
                $sum_limbah_cair = $limbah_cair->sum('ton_CO2eq');
                $sum_gas_alam_npk = $gas_alam_npk->sum('co2eq');
                $sum_fugitive = $fugitive->sum('co2_emission_ton_year');
                $sum_refrigerant_pabrik = $refrigerant_pabrik->sum('co2eq');
                $sum_refrigerant_non_pabrik = $refrigerant_non_pabrik->sum('co2eq');
                $sum_darat_gasoline = $darat_gasoline->sum('co2eq');
                $sum_darat_solar = $darat_solar->sum('co2eq');
                $sum_fasilitas_penunjang_gas_alam = $fasilitas_penunjang_gas_alam->sum('co2eq');
                $sum_fasilitas_penunjang_coal = $fasilitas_penunjang_coal->sum('co2eq');
                $sum_jvc_gas_alam = $jvc_gas_alam->sum('co2eq');
                $sum_jvc_coal = $jvc_coal->sum('co2eq');
                $sum_indirect_emission_kdm = $indirect_emission_kdm->sum('co2eq');
                $sum_penerbangan = $penerbangan->sum('ton_co2eq');
                $sum_pergudangan = $pergudangan->sum('co2eq');
                $sum_distribusi_kapal = $distribusi_kapal->sum('ton_co2eq');
                $sum_use_urea = $use_urea->sum('annual_co2eq');
                $sum_use_npk = $use_npk->sum('annual_co2eq');
                $sum_sampah_domestik = $sampah_domestik->sum('annual_CO2eq');

            //////////////////////////////////////////////////
            //PROYEKSI
            $pr_gas_alam = DB::table('tr_program_dekarbon as a')
                                ->select('a.rencana_pengurangan_emisi', 'a.rencana_penambahan_emisi', 'a.realisasi_pengurangan_emisi', 'a.realisasi_penambahan_emisi')
                                ->where('a.tahun', $tahun)
                                ->where('a.id_category', 1)
                                ->get();
            $pr_coal = DB::table('tr_program_dekarbon as a')
                                ->select('a.rencana_pengurangan_emisi', 'a.rencana_penambahan_emisi', 'a.realisasi_pengurangan_emisi', 'a.realisasi_penambahan_emisi')
                                ->where('a.tahun', $tahun)
                                ->where('a.id_category', 2)
                                ->get();
            $pr_ippu = DB::table('tr_program_dekarbon as a')
                                ->select('a.rencana_pengurangan_emisi', 'a.rencana_penambahan_emisi', 'a.realisasi_pengurangan_emisi', 'a.realisasi_penambahan_emisi')
                                ->where('a.tahun', $tahun)
                                ->where('a.id_category', 3)
                                ->get();
            $pr_limbah_cair = DB::table('tr_program_dekarbon as a')
                                ->select('a.rencana_pengurangan_emisi', 'a.rencana_penambahan_emisi', 'a.realisasi_pengurangan_emisi', 'a.realisasi_penambahan_emisi')
                                ->where('a.tahun', $tahun)
                                ->where('a.id_category', 4)
                                ->get();
            $pr_gas_alam_npk = DB::table('tr_program_dekarbon as a')
                                ->select('a.rencana_pengurangan_emisi', 'a.rencana_penambahan_emisi', 'a.realisasi_pengurangan_emisi', 'a.realisasi_penambahan_emisi')
                                ->where('a.tahun', $tahun)
                                ->where('a.id_category', 5)
                                ->get();
            $pr_fugitive = DB::table('tr_program_dekarbon as a')
                                ->select('a.rencana_pengurangan_emisi', 'a.rencana_penambahan_emisi', 'a.realisasi_pengurangan_emisi', 'a.realisasi_penambahan_emisi')
                                ->where('a.tahun', $tahun)
                                ->where('a.id_category', 6)
                                ->get();
            $pr_refrigerant_pabrik = DB::table('tr_program_dekarbon as a')
                                ->select('a.rencana_pengurangan_emisi', 'a.rencana_penambahan_emisi', 'a.realisasi_pengurangan_emisi', 'a.realisasi_penambahan_emisi')
                                ->where('a.tahun', $tahun)
                                ->where('a.id_category', 7)
                                ->get();
            $pr_refrigerant_non_pabrik = DB::table('tr_program_dekarbon as a')
                                ->select('a.rencana_pengurangan_emisi', 'a.rencana_penambahan_emisi', 'a.realisasi_pengurangan_emisi', 'a.realisasi_penambahan_emisi')
                                ->where('a.tahun', $tahun)
                                ->where('a.id_category', 8)
                                ->get();
            $pr_darat_gasoline = DB::table('tr_program_dekarbon as a')
                                ->select('a.rencana_pengurangan_emisi', 'a.rencana_penambahan_emisi', 'a.realisasi_pengurangan_emisi', 'a.realisasi_penambahan_emisi')
                                ->where('a.tahun', $tahun)
                                ->where('a.id_category', 9)
                                ->get();
            $pr_darat_solar = DB::table('tr_program_dekarbon as a')
                                ->select('a.rencana_pengurangan_emisi', 'a.rencana_penambahan_emisi', 'a.realisasi_pengurangan_emisi', 'a.realisasi_penambahan_emisi')
                                ->where('a.tahun', $tahun)
                                ->where('a.id_category', 10)
                                ->get();
            $pr_fasilitas_ng_cl = DB::table('tr_program_dekarbon as a')
                                ->select('a.rencana_pengurangan_emisi', 'a.rencana_penambahan_emisi', 'a.realisasi_pengurangan_emisi', 'a.realisasi_penambahan_emisi')
                                ->where('a.tahun', $tahun)
                                ->where('a.id_category', 11)
                                ->get();
            $pr_jvc_ng_cl = DB::table('tr_program_dekarbon as a')
                                ->select('a.rencana_pengurangan_emisi', 'a.rencana_penambahan_emisi', 'a.realisasi_pengurangan_emisi', 'a.realisasi_penambahan_emisi')
                                ->where('a.tahun', $tahun)
                                ->where('a.id_category', 12)
                                ->get();
            $pr_indirect_emission_kdm = DB::table('tr_program_dekarbon as a')
                                ->select('a.rencana_pengurangan_emisi', 'a.rencana_penambahan_emisi', 'a.realisasi_pengurangan_emisi', 'a.realisasi_penambahan_emisi')
                                ->where('a.tahun', $tahun)
                                ->where('a.id_category', 13)
                                ->get();
            $pr_penerbangan = DB::table('tr_program_dekarbon as a')
                                ->select('a.rencana_pengurangan_emisi', 'a.rencana_penambahan_emisi', 'a.realisasi_pengurangan_emisi', 'a.realisasi_penambahan_emisi')
                                ->where('a.tahun', $tahun)
                                ->where('a.id_category', 14)
                                ->get();
            $pr_pergudangan = DB::table('tr_program_dekarbon as a')
                                ->select('a.rencana_pengurangan_emisi', 'a.rencana_penambahan_emisi', 'a.realisasi_pengurangan_emisi', 'a.realisasi_penambahan_emisi')
                                ->where('a.tahun', $tahun)
                                ->where('a.id_category', 15)
                                ->get();
            $pr_distribusi_kapal = DB::table('tr_program_dekarbon as a')
                                ->select('a.rencana_pengurangan_emisi', 'a.rencana_penambahan_emisi', 'a.realisasi_pengurangan_emisi', 'a.realisasi_penambahan_emisi')
                                ->where('a.tahun', $tahun)
                                ->where('a.id_category', 16)
                                ->get();
            $pr_use_urea = DB::table('tr_program_dekarbon as a')
                                ->select('a.rencana_pengurangan_emisi', 'a.rencana_penambahan_emisi', 'a.realisasi_pengurangan_emisi', 'a.realisasi_penambahan_emisi')
                                ->where('a.tahun', $tahun)
                                ->where('a.id_category', 17)
                                ->get();
            $pr_use_npk = DB::table('tr_program_dekarbon as a')
                                ->select('a.rencana_pengurangan_emisi', 'a.rencana_penambahan_emisi', 'a.realisasi_pengurangan_emisi', 'a.realisasi_penambahan_emisi')
                                ->where('a.tahun', $tahun)
                                ->where('a.id_category', 18)
                                ->get();
            $pr_sampah_domestik = DB::table('tr_program_dekarbon as a')
                                ->select('a.rencana_pengurangan_emisi', 'a.rencana_penambahan_emisi', 'a.realisasi_pengurangan_emisi', 'a.realisasi_penambahan_emisi')
                                ->where('a.tahun', $tahun)
                                ->where('a.id_category', 19)
                                ->get();

            $pr_penambahan_emisi = array(
                $pr_gas_alam->sum('rencana_penambahan_emisi'),
                $pr_coal->sum('rencana_penambahan_emisi'),
                $pr_ippu->sum('rencana_penambahan_emisi'),
                $pr_limbah_cair->sum('rencana_penambahan_emisi'),
                $pr_gas_alam_npk->sum('rencana_penambahan_emisi'),
                $pr_fugitive->sum('rencana_penambahan_emisi'),
                $pr_refrigerant_pabrik->sum('rencana_penambahan_emisi'),
                $pr_refrigerant_non_pabrik->sum('rencana_penambahan_emisi'),
                $pr_darat_gasoline->sum('rencana_penambahan_emisi'),
                $pr_darat_solar->sum('rencana_penambahan_emisi'),
                $pr_fasilitas_ng_cl->sum('rencana_penambahan_emisi'),
                $pr_jvc_ng_cl->sum('rencana_penambahan_emisi'),
                $pr_indirect_emission_kdm->sum('rencana_penambahan_emisi'),
                $pr_penerbangan->sum('rencana_penambahan_emisi'),
                $pr_pergudangan->sum('rencana_penambahan_emisi'),
                $pr_distribusi_kapal->sum('rencana_penambahan_emisi'),
                $pr_use_urea->sum('rencana_penambahan_emisi'),
                $pr_use_npk->sum('rencana_penambahan_emisi'),
                $pr_sampah_domestik->sum('rencana_penambahan_emisi')
            );

            $pr_pengurangan_emisi = array(
                $pr_gas_alam->sum('rencana_pengurangan_emisi'),
                $pr_coal->sum('rencana_pengurangan_emisi'),
                $pr_ippu->sum('rencana_pengurangan_emisi'),
                $pr_limbah_cair->sum('rencana_pengurangan_emisi'),
                $pr_gas_alam_npk->sum('rencana_pengurangan_emisi'),
                $pr_fugitive->sum('rencana_pengurangan_emisi'),
                $pr_refrigerant_pabrik->sum('rencana_pengurangan_emisi'),
                $pr_refrigerant_non_pabrik->sum('rencana_pengurangan_emisi'),
                $pr_darat_gasoline->sum('rencana_pengurangan_emisi'),
                $pr_darat_solar->sum('rencana_pengurangan_emisi'),
                $pr_fasilitas_ng_cl->sum('rencana_pengurangan_emisi'),
                $pr_jvc_ng_cl->sum('rencana_pengurangan_emisi'),
                $pr_indirect_emission_kdm->sum('rencana_pengurangan_emisi'),
                $pr_penerbangan->sum('rencana_pengurangan_emisi'),
                $pr_pergudangan->sum('rencana_pengurangan_emisi'),
                $pr_distribusi_kapal->sum('rencana_pengurangan_emisi'),
                $pr_use_urea->sum('rencana_pengurangan_emisi'),
                $pr_use_npk->sum('rencana_pengurangan_emisi'),
                $pr_sampah_domestik->sum('rencana_pengurangan_emisi')
            );

            $realisasi_penambahan_emisi = array(
                $pr_gas_alam->sum('realisasi_penambahan_emisi'),
                $pr_coal->sum('realisasi_penambahan_emisi'),
                $pr_ippu->sum('realisasi_penambahan_emisi'),
                $pr_limbah_cair->sum('realisasi_penambahan_emisi'),
                $pr_gas_alam_npk->sum('realisasi_penambahan_emisi'),
                $pr_fugitive->sum('realisasi_penambahan_emisi'),
                $pr_refrigerant_pabrik->sum('realisasi_penambahan_emisi'),
                $pr_refrigerant_non_pabrik->sum('realisasi_penambahan_emisi'),
                $pr_darat_gasoline->sum('realisasi_penambahan_emisi'),
                $pr_darat_solar->sum('realisasi_penambahan_emisi'),
                $pr_fasilitas_ng_cl->sum('realisasi_penambahan_emisi'),
                $pr_jvc_ng_cl->sum('realisasi_penambahan_emisi'),
                $pr_indirect_emission_kdm->sum('realisasi_penambahan_emisi'),
                $pr_penerbangan->sum('realisasi_penambahan_emisi'),
                $pr_pergudangan->sum('realisasi_penambahan_emisi'),
                $pr_distribusi_kapal->sum('realisasi_penambahan_emisi'),
                $pr_use_urea->sum('realisasi_penambahan_emisi'),
                $pr_use_npk->sum('realisasi_penambahan_emisi'),
                $pr_sampah_domestik->sum('realisasi_penambahan_emisi')
            );

            $realisasi_pengurangan_emisi = array(
                $pr_gas_alam->sum('realisasi_pengurangan_emisi'),
                $pr_coal->sum('realisasi_pengurangan_emisi'),
                $pr_ippu->sum('realisasi_pengurangan_emisi'),
                $pr_limbah_cair->sum('realisasi_pengurangan_emisi'),
                $pr_gas_alam_npk->sum('realisasi_pengurangan_emisi'),
                $pr_fugitive->sum('realisasi_pengurangan_emisi'),
                $pr_refrigerant_pabrik->sum('realisasi_pengurangan_emisi'),
                $pr_refrigerant_non_pabrik->sum('realisasi_pengurangan_emisi'),
                $pr_darat_gasoline->sum('realisasi_pengurangan_emisi'),
                $pr_darat_solar->sum('realisasi_pengurangan_emisi'),
                $pr_fasilitas_ng_cl->sum('realisasi_pengurangan_emisi'),
                $pr_jvc_ng_cl->sum('realisasi_pengurangan_emisi'),
                $pr_indirect_emission_kdm->sum('realisasi_pengurangan_emisi'),
                $pr_penerbangan->sum('realisasi_pengurangan_emisi'),
                $pr_pergudangan->sum('realisasi_pengurangan_emisi'),
                $pr_distribusi_kapal->sum('realisasi_pengurangan_emisi'),
                $pr_use_urea->sum('realisasi_pengurangan_emisi'),
                $pr_use_npk->sum('realisasi_pengurangan_emisi'),
                $pr_sampah_domestik->sum('realisasi_pengurangan_emisi')
            );

            $bau = array(
                $sum_gas_alam,
                $sum_coal,
                $sum_ippu,
                $sum_limbah_cair,
                $sum_gas_alam_npk,
                $sum_fugitive,
                $sum_refrigerant_pabrik,
                $sum_refrigerant_non_pabrik,
                $sum_darat_gasoline,
                $sum_darat_solar,
                $sum_fasilitas_penunjang_gas_alam+$sum_fasilitas_penunjang_coal,
                $sum_jvc_gas_alam,
                $sum_indirect_emission_kdm,
                $sum_penerbangan,
                $sum_pergudangan,
                $sum_distribusi_kapal,
                $sum_use_urea,
                $sum_use_npk,
                $sum_sampah_domestik
            );

            if ($tahun == date("Y")-1) {
                $current_bau = $bau;
                // dd($tahun, $current_bau);
            }

            $sum_bau = array_sum($bau);

            $sum_pr_penambahan_emisi = array_sum($pr_penambahan_emisi);
            $sum_pr_pengurangan_emisi = array_sum($pr_pengurangan_emisi);

            $sum_realisasi_penambahan_emisi = array_sum($realisasi_penambahan_emisi);
            $sum_realisasi_pengurangan_emisi = array_sum($realisasi_pengurangan_emisi);

            if ($tahun >= date("Y")-1) {
                $sum_bau = array_sum($current_bau);
            }

            $chart_bau[] = array(
                'tahun' => strval($tahun),
                'total_bau' => $sum_bau + $sum_pr_penambahan_emisi,
                'total_rencana' => $sum_bau + $sum_pr_penambahan_emisi - $sum_pr_pengurangan_emisi,
                'total_realisasi' => $sum_bau + $sum_realisasi_penambahan_emisi - $sum_realisasi_pengurangan_emisi
            );

        }

        $current_category = [];
        foreach ($category as $key => $value) {
            $current_category[] = array(
                'category' => $value->category,
                'scope' => $value->scope,
                'scope_desc' => $value->scope_desc,
                'total' => $current_bau[$key]
            );
        }

        $current_scope = [];
        foreach ($current_category as $value) {
            $key = $value['scope'];
            $key = $key - 1;
            if (!array_key_exists($key, $current_scope)) {
                # code...
                $current_scope[$key] = array(
                    'scope' => $value['scope_desc'],
                    'total' => $value['total']
                );
            }else{
                $current_scope[$key]['total'] = $current_scope[$key]['total'] + $value['total'];
            }
        }

        // dd($current_scope, $current_category);
        ///////////////////////////////////////
        ///////////////////////////////////////
        ///////////////////////////////////////
        // intensitas emisi
        $intensitas_emisi = DB::table('map_intensitas_emisi')->get();
        $total_produk = DB::table('total_produk')->get();
        $current_intensitas_emisi = [];
        
        $emisi_amonia = 0;
        foreach($intensitas_emisi as $data){
            if ($data->id_sumber_emisi == 1) {
                $gas_alam = DB::table('vw_gas_alam as a')
                                ->select('a.co2eq')
                                ->where('a.tahun', 2022)
                                ->where('a.id_sumber_emisi', 1)
                                ->get();
                $coal = DB::table('vw_coal as a')
                                ->select('a.co2eq')
                                ->where('a.tahun', 2022)
                                ->where('a.id_sumber_emisi', 1)
                                ->get();
                $ippu = DB::table('vw_ippu as a')
                                ->select('a.co2_emissions')
                                ->where('a.tahun', 2022)
                                ->get();
                $indirect_emission_kdm = DB::table('vw_indirect_emission_kdm as a')
                                ->select('a.co2eq')
                                ->where('a.tahun', 2022)
                                ->where('a.id_sumber_emisi', 1)
                                ->get();

                $emisi_amonia = $gas_alam->sum('co2eq') + $coal->sum('co2eq') + $ippu->sum('co2_emissions') + $indirect_emission_kdm->sum('co2eq');

                $total_produk_amonia = $total_produk[1]->total / $total_produk[0]->total;

                $total_emisi_ddj = $total_produk_amonia * $emisi_amonia;

                $current_intensitas_emisi[] = array(
                    'sumber_emisi' => 'Produk Amoniak DDJ',
                    'total' => $total_emisi_ddj / $total_produk[1]->total
                );
            }

            if ($data->id_sumber_emisi == 2) {
                
                $gas_alam = DB::table('vw_gas_alam as a')
                                ->select('a.co2eq')
                                ->where('a.tahun', 2022)
                                ->where('a.id_sumber_emisi', 2)
                                ->whereIn('id_pabrik', ['1', '4', '5'])
                                ->get();
                $coal = DB::table('vw_coal as a')
                                ->select('a.co2eq')
                                ->where('a.tahun', 2022)
                                ->where('a.id_sumber_emisi', 2)
                                ->whereIn('id_pabrik', ['1', '4', '5'])
                                ->get();
                $indirect_emission_kdm = DB::table('vw_indirect_emission_kdm as a')
                                ->select('a.co2eq')
                                ->where('a.tahun', 2022)
                                ->where('a.id_sumber_emisi', 2)
                                ->whereIn('id_pabrik', ['1', '4', '5'])
                                ->get();

                $emisi_produk_urea_granul = $gas_alam->sum('co2eq') + $coal->sum('co2eq') + $indirect_emission_kdm->sum('co2eq');
                $total_amonia_untuk_urea_granul = ($total_produk[5]->total / ($total_produk[4]->total + $total_produk[5]->total)) * $emisi_amonia;

                $emisi_urea_granul = $emisi_produk_urea_granul + $total_amonia_untuk_urea_granul;

                $current_intensitas_emisi[] = array(
                    'sumber_emisi' => 'Produk Urea Granul',
                    'total' => $emisi_urea_granul / $total_produk[5]->total
                );
                ///////////////////////
                ///////////////////////
                ///////////////////////
                $gas_alam = DB::table('vw_gas_alam as a')
                                ->select('a.co2eq')
                                ->where('a.tahun', 2022)
                                ->where('a.id_sumber_emisi', 2)
                                ->whereIn('id_pabrik', ['2', '3'])
                                ->get();
                $coal = DB::table('vw_coal as a')
                                ->select('a.co2eq')
                                ->where('a.tahun', 2022)
                                ->where('a.id_sumber_emisi', 2)
                                ->whereIn('id_pabrik', ['2', '3'])
                                ->get();
                $indirect_emission_kdm = DB::table('vw_indirect_emission_kdm as a')
                                ->select('a.co2eq')
                                ->where('a.tahun', 2022)
                                ->where('a.id_sumber_emisi', 2)
                                ->whereIn('id_pabrik', ['2', '3'])
                                ->get();

                $emisi_produk_urea_prill = $gas_alam->sum('co2eq') + $coal->sum('co2eq') + $indirect_emission_kdm->sum('co2eq');
                $total_amonia_untuk_urea_prill = ($total_produk[4]->total / ($total_produk[4]->total + $total_produk[5]->total)) * $emisi_amonia;

                $emisi_urea_prill = $emisi_produk_urea_prill + $total_amonia_untuk_urea_prill;

                $current_intensitas_emisi[] = array(
                    'sumber_emisi' => 'Produk Urea Prill',
                    'total' => $emisi_urea_prill / $total_produk[4]->total
                );
            }

            if ($data->id_sumber_emisi == 4) {
                $gas_alam = DB::table('vw_gas_alam as a')
                                ->select('a.co2eq')
                                ->where('a.tahun', 2022)
                                ->where('a.id_sumber_emisi', 4)
                                ->get();
                $current_intensitas_emisi[] = array(
                    'sumber_emisi' => 'Produk NPK',
                    'total' => $gas_alam->sum('co2eq') / $total_produk[6]->total
                );
            }
        }

        return response()->json(array('chart_bau'   => $chart_bau, 'current_category' => $current_category, 'current_scope' => $current_scope, 'current_intensitas_emisi' => $current_intensitas_emisi));
    }

    public function loadbaseline(Request $request, Core $devextreme) //dx grid
    {
        $baseline = DB::table('baseline as a')->select('a.*', 'b.category as category_desc')->join('vl_category as b', 'a.category', 'b.id');
        $data = $devextreme->data($baseline, $request, 'id');
        $datax1 = array();
        foreach ($data['datax'] as $d) {
            $datax1[] = array(
                'id' => Core::encodex($d->id),
                'emission' => $d->emission,
                'inventory' => $d->inventory,
                'sector' => $d->sector,
                'scope' => $d->scope,
                'category' => $d->category_desc,
                'tahun' => $d->tahun,
                'business_as_usual' => $d->business_as_usual,
                'pengurangan_emisi_CO2' => $d->pengurangan_emisi_CO2,
                'penambahan_emisi_CO2' => $d->penambahan_emisi_CO2,
                'realisasi_pengurangan_emisi_CO2' => $d->realisasi_pengurangan_emisi_CO2,
                'realisasi_penambahan_emisi_CO2' => $d->realisasi_penambahan_emisi_CO2,
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
        Excel::import(new ImportBaseline, $request->file('file')->store('files'));
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // add baseline
    public function add(Request $request)
    {
        $existing = Baseline::where('tahun', $request->tahun)->where('category', $request->category)->first();
        if ($existing) {
            return response()->json(array('messageinput'   => '0', 'message' => 'Data Gagal ditambahkan, master data sudah tersedia!'));
        }

        $baseline = new Baseline([
            'emission' => $request->emission,
            'inventory' => $request->inventory,
            'sector' => $request->sector,
            'scope' => $request->scope,
            'category' => $request->category,
            'tahun' => $request->tahun,
            'business_as_usual' => $request->business_as_usual,
            'pengurangan_emisi_CO2' => $request->pengurangan_emisi_CO2,
            'penambahan_emisi_CO2' => $request->penambahan_emisi_CO2,
            'realisasi_pengurangan_emisi_CO2' => $request->realisasi_pengurangan_emisi_CO2,
            'realisasi_penambahan_emisi_CO2' => $request->realisasi_penambahan_emisi_CO2,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);
        $baseline->save();
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // edit baseline
    public function edit($id)
    {
        // $baseline = Baseline::find(Core::decodex($id));
        $baseline = DB::table('baseline as a')
                        ->select('a.*', 'b.category as category_desc')
                        ->join('vl_category as b', 'a.category', 'b.id')
                        ->where('a.id', Core::decodex($id))
                        ->first();
        return response()->json($baseline);
    }

    // update baseline
    public function update($id, Request $request)
    {
        $baseline = Baseline::find($id);
        $baseline->update($request->all());
        return response()->json(array('messageinput'   => '1', 'message' => 'Data Berhasil disimpan.'));
    }

    // delete baseline
    public function delete($id)
    {
        $baseline = Baseline::find(Core::decodex($id));
        $baseline->delete();

        return response()->json('The baseline successfully deleted');
    }    
    /////////////////////////// end master data

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
}
