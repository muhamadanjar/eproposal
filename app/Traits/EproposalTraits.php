<?php

namespace App\Traits;
use App\Usulan;
trait EproposalTraits
{
	public function getShowUsulanQuery($id=''){
        $usulan ='';
        if (!empty($id)) {
            if (auth()->user()->isSuper() || auth()->user()->isManager()) {
                $usulan = Usulan::join('provinsi', 'provinsi.kode_provinsi', '=', 'usulan.kode_provinsi')
                ->join('kabupaten', 'kabupaten.kode_kabupaten', '=', 'usulan.kode_kabupaten')
                ->join('kecamatan', 'kecamatan.kode_kecamatan', '=', 'usulan.kode_kecamatan')
                ->select('usulan.*', 'provinsi.provinsi','kabupaten.kabupaten','kecamatan.kecamatan')
                ->where('usulan.id',$id)
                ->orderBy('updated_at','DESC')
                ->first();
            }else{
                $usulan = Usulan::join('provinsi', 'provinsi.kode_provinsi', '=', 'usulan.kode_provinsi')
                ->join('kabupaten', 'kabupaten.kode_kabupaten', '=', 'usulan.kode_kabupaten')
                ->join('kecamatan', 'kecamatan.kode_kecamatan', '=', 'usulan.kode_kecamatan')
                ->select('usulan.*', 'provinsi.provinsi','kabupaten.kabupaten','kecamatan.kecamatan')
                ->where('usulan.id',$id)
                ->where('usulan.user_id',auth()->user()->id)
                ->orderBy('updated_at','DESC')
                ->first();
            }
        }else{
            if (auth()->user()->isSuper() || auth()->user()->isManager()) {
                $usulan = Usulan::join('provinsi', 'provinsi.kode_provinsi', '=', 'usulan.kode_provinsi')
                ->join('kabupaten', 'kabupaten.kode_kabupaten', '=', 'usulan.kode_kabupaten')
                ->join('kecamatan', 'kecamatan.kode_kecamatan', '=', 'usulan.kode_kecamatan')
                ->select('usulan.*', 'provinsi.provinsi','kabupaten.kabupaten','kecamatan.kecamatan')
                ->orderBy('updated_at','DESC')
                ->get();
            }else{
                $usulan = Usulan::join('provinsi', 'provinsi.kode_provinsi', '=', 'usulan.kode_provinsi')
                ->join('kabupaten', 'kabupaten.kode_kabupaten', '=', 'usulan.kode_kabupaten')
                ->join('kecamatan', 'kecamatan.kode_kecamatan', '=', 'usulan.kode_kecamatan')
                ->select('usulan.*', 'provinsi.provinsi','kabupaten.kabupaten','kecamatan.kecamatan')
                ->where('usulan.user_id',auth()->user()->id)
                ->orderBy('updated_at','DESC')
                ->get();
            }
        }
        return $usulan;
    }
}