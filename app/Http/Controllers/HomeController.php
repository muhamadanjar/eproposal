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
        $totallain = $this->getTotalLainnya();
        
        $jumlah_usulan = $this->getJumlahUsulan();
        return view('master.dashboard')
        ->with('totalsab',$totalsab)
        ->with('totalplts',$totalplts)
        ->with('totallain',$totallain)
        ->with('jumlah_usulan',$jumlah_usulan)
        
        ->with('totaljalan',$totaljalan);
    }


    public function getTotalJalan($value=''){
        $jalan = DB::table('usulan')
            ->select(DB::raw('SUM(jumlah_usulan) as total'))
            ->where('jenis_usulan',1)
            ->where('user_id',auth()->user()->id)
            ->get();
        if(auth()->user()->isManager()){
            $jalan = DB::table('usulan')
            ->select(DB::raw('SUM(jumlah_usulan) as total'))
            ->where('jenis_usulan',1)->get();
        }
        return $jalan;

    }

    public function getTotalSab($value=''){
        $sab = DB::table('usulan')
        ->select(DB::raw('SUM(jumlah_usulan) as total'))
        ->where('user_id',auth()->user()->id)
        ->where('jenis_usulan',2)->get();
        if(auth()->user()->isManager()){
            $sab = DB::table('usulan')
                ->select(DB::raw('SUM(jumlah_usulan) as total'))
                ->where('jenis_usulan',2)->get();
        }
        return $sab;

    }

    public function getTotalPlts($value=''){
        $plts = DB::table('usulan')
        ->select(DB::raw('SUM(jumlah_usulan) as total'))
        ->where('user_id',auth()->user()->id)
        ->where('jenis_usulan',3)->get();
        if(auth()->user()->isManager()){
            $plts = DB::table('usulan')
            ->select(DB::raw('SUM(jumlah_usulan) as total'))
            ->where('jenis_usulan',3)->get();
        }
        return $plts;

    }

    public function getTotalLainnya($value=''){
        $lainnya = DB::table('usulan')
        ->select(DB::raw('SUM(jumlah_usulan) as total'))
        ->where('user_id',auth()->user()->id)
        ->where('jenis_usulan',4)->get();
        if(auth()->user()->isManager()){
            $lainnya = DB::table('usulan')
            ->select(DB::raw('SUM(jumlah_usulan) as total'))
            ->where('jenis_usulan',4)->get();
        }
        return $lainnya;

    }

    public function getJumlahUsulan($value='')
    {
        $usulan = DB::table('usulan')->where('user_id',auth()->user()->id)->count();
        if(auth()->user()->isManager()){
            $usulan = DB::table('usulan')->count();
        }
        return $usulan;
    }


}
