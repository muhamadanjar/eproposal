<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersyaratanCtrl extends Controller
{
    public function __construct($value=''){
    	$this->middleware('auth');
    }

    public function getJalan(){
    	return view('persyaratan.jalanList');
    }

    

    public function getSab($value=''){
    	return view('persyaratan.sabList');
    }

    public function getPlts($value=''){
    	return view('persyaratan.pltsList');
    }
}
