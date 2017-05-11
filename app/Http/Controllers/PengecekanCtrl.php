<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usulan;
use DB;
class PengecekanCtrl extends Controller
{
   	public function getIndex(){
   	 	return view('usulan.pengecekanUsulanList');
   	}

   	public function getUsulan($id=''){
   		$usulan = Usulan::join('provinsi', 'provinsi.kode_provinsi', '=', 'usulan.kode_provinsi')
        ->join('kabupaten', 'kabupaten.kode_kabupaten', '=', 'usulan.kode_kabupaten')
        ->join('kecamatan', 'kecamatan.kode_kecamatan', '=', 'usulan.kode_kecamatan')
        ->select('usulan.*', 'provinsi.provinsi','kabupaten.kabupaten','kecamatan.kecamatan')
        ->where('usulan.id',$id)
        ->first();
        
      $pjalan = DB::table('usulan_persyaratan_jalan')
                ->join('usulan','usulan.id','usulan_persyaratan_jalan.usulan_id')
                ->join('pjalan','pjalan.id','usulan_persyaratan_jalan.pjalan_id')
                ->select(
                    'usulan.id as UsulID',
                    'pjalan.no',
                    'pjalan.namausulan',
                    'pjalan.tipeusulan',
                    'usulan_persyaratan_jalan.isi',
                    'usulan_persyaratan_jalan.file',
                    'usulan_persyaratan_jalan.verifikasi'
                )
                ->orderBy('tipeusulan','ASC')
                ->orderBy('no','ASC')
                ->where('usulan_persyaratan_jalan.usulan_id',$id)
                ->get();
      $usulan['pjalan'] = $pjalan;
   		return view('usulan.pengecekanUsulan')->withUsulan($usulan);
   	}
}
