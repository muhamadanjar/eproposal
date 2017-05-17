<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class PersyaratanCtrl extends Controller
{
    public function __construct($value=''){
    	$this->middleware('auth');
    }

    public function getArrayJalan($value=''){
        $usulan = DB::table('pjalan')->get();
        $array = array();
        foreach ($usulan as $key => $value) {
            $array['data'][$key] = $value;
        }
        return $array;
    }

    public function getArraySab($value=''){
        $usulan = DB::table('psab')->get();
        $array = array();
        foreach ($usulan as $key => $value) {
            $array['data'][$key] = $value;
        }
        return $array;
    }

    public function getArrayPlts($value=''){
        $usulan = DB::table('pplts')->get();
        $array = array();
        foreach ($usulan as $key => $value) {
            $array['data'][$key] = $value;
        }
        return $array;
    }

    public function getJalan(){
        $jalan = DB::table('pjalan')->get();
    	return view('persyaratan.jalanList')->with('jalan',$jalan);
    }

    public function getSab($value=''){
        $sab = DB::table('psab')->get();
    	return view('persyaratan.sabList')->with('sab',$sab);
    }

    public function getPlts($value=''){
        $plts = DB::table('pplts')->get();
    	return view('persyaratan.pltsList')->with('plts',$plts);
    }
}
