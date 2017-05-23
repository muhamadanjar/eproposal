<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class HomeController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totaljalan = $this->getTotalJalan();
        $totalsab = $this->getTotalSab();
        $totalplts = $this->getTotalPlts();

        $jumlah_usulan = $this->getJumlahUsulan();
        return view('master.dashboard')
        ->with('totalsab',$totalsab)
        ->with('totalplts',$totalplts)
        ->with('jumlah_usulan',$jumlah_usulan)
        
        ->with('totaljalan',$totaljalan);
    }


    public function getTotalJalan($value=''){
        return DB::table('usulan')
        ->select(DB::raw('SUM(jumlah_usulan) as total'))
        ->where('jenis_usulan',1)->get();

    }

    public function getTotalSab($value=''){
        return DB::table('usulan')
        ->select(DB::raw('SUM(jumlah_usulan) as total'))
        ->where('jenis_usulan',2)->get();

    }

    public function getTotalPlts($value=''){
        return DB::table('usulan')
        ->select(DB::raw('SUM(jumlah_usulan) as total'))
        ->where('jenis_usulan',3)->get();

    }

    public function getJumlahUsulan($value='')
    {
        return DB::table('usulan')->count();
    }


}
