<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jalan;
use App\SAB;
use App\PLTS;
use Auth;
use Gate;
class PembangunanCtrl extends Controller
{	
	public function getJalan(){
        if (! $this->authorize('access.backend')) {
           return "I can't create new user :(";
        }
        
        session(['usulan' => $_GET['usulan']]);
        return view('jalansirip');
        
        
    }
    
    public function postJalan(Request $request){
    	$jalan = new Jalan();
    	$jalan->jalan_admin_1 = $request->jalan_admin_1;
    	$jalan->jalan_admin_2 = $request->jalan_admin_2;
    	$jalan->jalan_admin_2a = $request->jalan_admin_2a;
    	$jalan->jalan_admin_2b = $request->jalan_admin_2b;
    	$jalan->jalan_admin_2c = $request->jalan_admin_2c;

    	$jalan->jalan_admin_3 = $request->jalan_admin_3;
    	$jalan->jalan_admin_4 = $request->jalan_admin_4;
    	$jalan->jalan_admin_5 = $request->jalan_admin_5;
    	$jalan->jalan_admin_6 = $request->jalan_admin_6;
    	$jalan->jalan_admin_7 = $request->jalan_admin_7;
    	$jalan->jalan_admin_8 = $request->jalan_admin_8;
    	$jalan->jalan_admin_9 = $request->jalan_admin_9;

    	$jalan->jalan_teknis_1 = $request->jalan_teknis_1;
    	$jalan->jalan_teknis_1a = $request->jalan_teknis_1a;
    	$jalan->jalan_teknis_1b = $request->jalan_teknis_1b;
    	$jalan->jalan_teknis_1c = $request->jalan_teknis_1c;
    	$jalan->jalan_teknis_1d = $request->jalan_teknis_1d;
    	$jalan->jalan_teknis_1e = $request->jalan_teknis_1e;
    	$jalan->jalan_teknis_1f = $request->jalan_teknis_1f;
    	$jalan->jalan_teknis_1g = $request->jalan_teknis_1g;
    	$jalan->jalan_teknis_1h = $request->jalan_teknis_1h;
    	$jalan->jalan_teknis_1i = $request->jalan_teknis_1i;
    	$jalan->jalan_teknis_1j = $request->jalan_teknis_1j;
    	$jalan->jalan_teknis_1k = $request->jalan_teknis_1k;
     
     	$jalan->jalan_teknis_2 = $request->jalan_teknis_2;
     	$jalan->jalan_teknis_2a = $request->jalan_teknis_2a;
     	$jalan->jalan_teknis_2b = $request->jalan_teknis_2b;
     	$jalan->jalan_teknis_2c = $request->jalan_teknis_2c;
     	$jalan->jalan_teknis_2d = $request->jalan_teknis_2d;
     	$jalan->jalan_teknis_2e = $request->jalan_teknis_2e;
     	$jalan->jalan_teknis_2f = $request->jalan_teknis_2f;
     	$jalan->jalan_teknis_2g = $request->jalan_teknis_2g;
     	$jalan->jalan_teknis_2h = $request->jalan_teknis_2h;
     	$jalan->jalan_teknis_2i = $request->jalan_teknis_2i;
     	$jalan->jalan_teknis_2j = $request->jalan_teknis_2j;
     	$jalan->jalan_teknis_3 = $request->jalan_teknis_3;
     	$jalan->jalan_teknis_3a = $request->jalan_teknis_3a;
     	$jalan->jalan_teknis_3b = $request->jalan_teknis_3b;
     	$jalan->jalan_teknis_3c = $request->jalan_teknis_3c;
 
     	$jalan->jalan_teknis_4 = $request->jalan_teknis_4;
     	$jalan->jalan_teknis_5 = $request->jalan_teknis_5;
     	$jalan->jalan_teknis_6 = $request->jalan_teknis_6;
        $jalan->user_id = Auth::user()->id;
        
        $jalan->status = 0;
        $jalan->usulan_id = session('usulan');
    	
    	$jalan->save();
    	$request->session()->flash('Usulanstatus', 'Data Sudah di tampung!');

    	return redirect('/proposal/usulan');
    }

    public function getSab($value=''){
        if (! $this->authorize('access.backend')) {
           return "I can't create new user :(";
        }
        session(['usulan' => $_GET['usulan']]);
        return view('sab');
    }

    public function postSab(Request $request){
        $sab = new SAB();
        $sab->sab_admin_1 = $request->sab_admin_1;
        $sab->sab_admin_2 = $request->sab_admin_2;
        $sab->sab_admin_2a = $request->sab_admin_2a;
        $sab->sab_admin_2b = $request->sab_admin_2b;
        $sab->sab_admin_2c = $request->sab_admin_2c;

        $sab->sab_admin_3 = $request->sab_admin_3;
        $sab->sab_admin_4 = $request->sab_admin_4;
        $sab->sab_admin_5 = $request->sab_admin_5;
        $sab->sab_admin_6 = $request->sab_admin_6;
        $sab->sab_admin_7 = $request->sab_admin_7;
        $sab->sab_admin_8 = $request->sab_admin_8;
        $sab->sab_admin_9 = $request->sab_admin_9;

        $sab->sab_teknis_1 = $request->sab_teknis_1;
        $sab->sab_teknis_1a = $request->sab_teknis_1a;
        $sab->sab_teknis_1b = $request->sab_teknis_1b;
        $sab->sab_teknis_1c = $request->sab_teknis_1c;
        $sab->sab_teknis_1d = $request->sab_teknis_1d;
        $sab->sab_teknis_1e = $request->sab_teknis_1e;
        $sab->sab_teknis_1f = $request->sab_teknis_1f;
        $sab->sab_teknis_1g = $request->sab_teknis_1g;
        $sab->sab_teknis_1h = $request->sab_teknis_1h;
        $sab->sab_teknis_1i = $request->sab_teknis_1i;
        $sab->sab_teknis_1j = $request->sab_teknis_1j;
        
        $sab->sab_teknis_2 = $request->sab_teknis_2;
        $sab->sab_teknis_2a = $request->sab_teknis_2a;
        $sab->sab_teknis_2b = $request->sab_teknis_2b;
        $sab->sab_teknis_2c = $request->sab_teknis_2c;
        $sab->sab_teknis_2d = $request->sab_teknis_2d;
        $sab->sab_teknis_2e = $request->sab_teknis_2e;
        $sab->sab_teknis_2f = $request->sab_teknis_2f;
        $sab->sab_teknis_2g = $request->sab_teknis_2g;
        $sab->sab_teknis_2h = $request->sab_teknis_2h;
        $sab->sab_teknis_2i = $request->sab_teknis_2i;
        $sab->sab_teknis_2j = $request->sab_teknis_2j;
        $sab->sab_teknis_2k = $request->sab_teknis_2k;

        $sab->sab_teknis_3 = $request->sab_teknis_3;
        $sab->sab_teknis_3a = $request->sab_teknis_3a;
        $sab->sab_teknis_3b = $request->sab_teknis_3b;
        $sab->sab_teknis_3c = $request->sab_teknis_3c;
 
        $sab->sab_teknis_4 = $request->sab_teknis_4;
        $sab->sab_teknis_5 = $request->sab_teknis_5;
        $sab->sab_teknis_6 = $request->sab_teknis_6;
        $sab->sab_teknis_7 = $request->sab_teknis_7;
        $sab->sab_teknis_8 = $request->sab_teknis_8;
        $sab->sab_teknis_9 = $request->sab_teknis_9;

        $sab->status = 0;
        $sab->user_id = Auth::user()->id;
        $sab->usulan_id = session('usulan');
        
        $sab->save();
        $request->session()->flash('Usulanstatus', 'Data Sudah di tampung!');

        return redirect('/proposal/usulan');
    }

    public function getPlts($value=''){
        if (! $this->authorize('access.backend')) {
           return "I can't create new user :(";
        }
        session(['usulan' => $_GET['usulan']]);
        return view('plts');
    }

    public function postPlts(Request $request){
        $plts = new plts();
        $plts->plts_admin_1 = $request->plts_admin_1;
        $plts->plts_admin_2 = $request->plts_admin_2;
        $plts->plts_admin_2a = $request->plts_admin_2a;
        $plts->plts_admin_2b = $request->plts_admin_2b;
        $plts->plts_admin_2c = $request->plts_admin_2c;

        $plts->plts_admin_3 = $request->plts_admin_3;
        $plts->plts_admin_4 = $request->plts_admin_4;
        $plts->plts_admin_5 = $request->plts_admin_5;
        $plts->plts_admin_6 = $request->plts_admin_6;
        $plts->plts_admin_7 = $request->plts_admin_7;
        $plts->plts_admin_8 = $request->plts_admin_8;
        $plts->plts_admin_9 = $request->plts_admin_9;

        $plts->plts_teknis_1 = $request->plts_teknis_1;
        $plts->plts_teknis_1a = $request->plts_teknis_1a;
        $plts->plts_teknis_1b = $request->plts_teknis_1b;
        $plts->plts_teknis_1c = $request->plts_teknis_1c;
        $plts->plts_teknis_1d = $request->plts_teknis_1d;
        $plts->plts_teknis_1e = $request->plts_teknis_1e;
        $plts->plts_teknis_1f = $request->plts_teknis_1f;
        $plts->plts_teknis_1g = $request->plts_teknis_1g;
        $plts->plts_teknis_1h = $request->plts_teknis_1h;
        $plts->plts_teknis_1i = $request->plts_teknis_1i;
        $plts->plts_teknis_1j = $request->plts_teknis_1j;
        
        $plts->plts_teknis_2 = $request->plts_teknis_2;
        $plts->plts_teknis_2a = $request->plts_teknis_2a;
        $plts->plts_teknis_2b = $request->plts_teknis_2b;
        $plts->plts_teknis_2c = $request->plts_teknis_2c;
        $plts->plts_teknis_2d = $request->plts_teknis_2d;
        $plts->plts_teknis_2e = $request->plts_teknis_2e;
        $plts->plts_teknis_2f = $request->plts_teknis_2f;
        $plts->plts_teknis_2g = $request->plts_teknis_2g;
        $plts->plts_teknis_2h = $request->plts_teknis_2h;
        $plts->plts_teknis_2i = $request->plts_teknis_2i;
        $plts->plts_teknis_2j = $request->plts_teknis_2j;
        $plts->plts_teknis_2k = $request->plts_teknis_2k;

        $plts->plts_teknis_3 = $request->plts_teknis_3;
        $plts->plts_teknis_3a = $request->plts_teknis_3a;
        $plts->plts_teknis_3b = $request->plts_teknis_3b;
        $plts->plts_teknis_3c = $request->plts_teknis_3c;
        $plts->plts_teknis_3d = $request->plts_teknis_3d;
 
        $plts->plts_teknis_4 = $request->plts_teknis_4;
        $plts->plts_teknis_5 = $request->plts_teknis_5;
        $plts->plts_teknis_6 = $request->plts_teknis_6;
        $plts->plts_teknis_7 = $request->plts_teknis_7;
        $plts->status = 0;
        $plts->user_id = Auth::user()->id;
        $plts->usulan_id = session('usulan');

        
        $plts->save();
        $request->session()->flash('Usulanstatus', 'Data Sudah di tampung!');
        return redirect('/proposal/usulan');
    }
}
