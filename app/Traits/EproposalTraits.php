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
                ->join('users', 'users.id', '=', 'usulan.user_id')
                ->select('usulan.*', 'provinsi.provinsi','kabupaten.kabupaten','kecamatan.kecamatan','users.name as UserNama')
                ->where('usulan.id',$id)
                ->orderBy('updated_at','DESC')
                ->first();
            }else{
                $usulan = Usulan::join('provinsi', 'provinsi.kode_provinsi', '=', 'usulan.kode_provinsi')
                ->join('kabupaten', 'kabupaten.kode_kabupaten', '=', 'usulan.kode_kabupaten')
                ->join('kecamatan', 'kecamatan.kode_kecamatan', '=', 'usulan.kode_kecamatan')
                ->join('users', 'users.id', '=', 'usulan.user_id')
                ->select('usulan.*', 'provinsi.provinsi','kabupaten.kabupaten','kecamatan.kecamatan','users.name as UserNama')
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
                ->join('users', 'users.id', '=', 'usulan.user_id')
                ->select('usulan.*', 'provinsi.provinsi','kabupaten.kabupaten','kecamatan.kecamatan','users.name as UserNama')
                ->orderBy('updated_at','DESC')
                ->get();
            }else{
                $usulan = Usulan::join('provinsi', 'provinsi.kode_provinsi', '=', 'usulan.kode_provinsi')
                ->join('kabupaten', 'kabupaten.kode_kabupaten', '=', 'usulan.kode_kabupaten')
                ->join('kecamatan', 'kecamatan.kode_kecamatan', '=', 'usulan.kode_kecamatan')
                ->join('users', 'users.id', '=', 'usulan.user_id')
                ->select('usulan.*', 'provinsi.provinsi','kabupaten.kabupaten','kecamatan.kecamatan','users.name as UserNama')
                ->where('usulan.user_id',auth()->user()->id)
                ->orderBy('updated_at','DESC')
                ->get();
            }
        }
        return $usulan;
    }

    public function getUserQuery($id=''){
        $user = App\User::join('role_user','users.id','role_user.user_id')
            ->join('roles','role_user.role_id','roles.id')
            ->select('users.*','roles.name as RoleName')
            ->first();
        if (!empty($id)) {
            $user = App\User::join('role_user','users.id','role_user.user_id')
            ->join('roles','role_user.role_id','roles.id')->where('users.id',$id)
            ->select('users.*','roles.name as RoleName')
            ->first();
        }
        

        return $user;
    }
}