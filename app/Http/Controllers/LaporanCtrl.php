<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jalan;
use App\SAB;
use App\PLTS;
use Auth;
use Gate;
use App\Provinsi;
class LaporanCtrl extends Controller
{	
	public function __construct($value=''){
        $this->middleware('auth');
    }

    public function getUsulan($value=''){
        $provinsi = Provinsi::orderBy('kode_provinsi')->get();
        return view('laporan.usulan')
            ->withProvinsi($provinsi);
    }
}
