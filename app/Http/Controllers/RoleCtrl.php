<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
class RoleCtrl extends Controller{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function getIndex($value=''){
    	if (! $this->authorize('access.backend')) {
           return "Halaman tidak di ijinkan :(";
        }

    	$role = Role::orderBy('id')->get();
    	return view('master.role')->withRole($role);
    }
}
