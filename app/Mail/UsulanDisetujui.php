<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Usulan;
class UsulanDisetujui extends Mailable
{
    use Queueable, SerializesModels;

    
    public function __construct(Usulan $usulan){
        $this->usulan = $this->getShowUsulanQuery($usulan->id);
    }

    
    public function build(){
        return $this->view('emails.usulan.disetujui')
        ->subject('Usulan Sudah disetujui')
            ->with([
                'usulanName' => $this->usulan->skpd_pengusul,
                'usulanDesa' => $this->usulan->desa,
                'usulanData' => $this->usulan,
            ]);;
    }

    public function getShowUsulanQuery($id=''){
        $usulan ='';
        if (!empty($id)) {
            if (auth()->user()->isSuper() || auth()->user()->isManager()) {
                $usulan = Usulan::join('provinsi', 'provinsi.kode_provinsi', '=', 'usulan.kode_provinsi')
                ->join('kabupaten', 'kabupaten.kode_kabupaten', '=', 'usulan.kode_kabupaten')
                ->join('kecamatan', 'kecamatan.kode_kecamatan', '=', 'usulan.kode_kecamatan')
                ->select('usulan.*', 'provinsi.provinsi','kabupaten.kabupaten','kecamatan.kecamatan')
                ->where('usulan.id',$id)
                ->first();
            }else{
                $usulan = Usulan::join('provinsi', 'provinsi.kode_provinsi', '=', 'usulan.kode_provinsi')
                ->join('kabupaten', 'kabupaten.kode_kabupaten', '=', 'usulan.kode_kabupaten')
                ->join('kecamatan', 'kecamatan.kode_kecamatan', '=', 'usulan.kode_kecamatan')
                ->select('usulan.*', 'provinsi.provinsi','kabupaten.kabupaten','kecamatan.kecamatan')
                ->where('usulan.id',$id)
                ->where('usulan.user_id',auth()->user()->id)
                ->first();
            }
        }else{
            if (auth()->user()->isSuper() || auth()->user()->isManager()) {
                $usulan = Usulan::join('provinsi', 'provinsi.kode_provinsi', '=', 'usulan.kode_provinsi')
                ->join('kabupaten', 'kabupaten.kode_kabupaten', '=', 'usulan.kode_kabupaten')
                ->join('kecamatan', 'kecamatan.kode_kecamatan', '=', 'usulan.kode_kecamatan')
                ->select('usulan.*', 'provinsi.provinsi','kabupaten.kabupaten','kecamatan.kecamatan')
                ->get();
            }else{
                $usulan = Usulan::join('provinsi', 'provinsi.kode_provinsi', '=', 'usulan.kode_provinsi')
                ->join('kabupaten', 'kabupaten.kode_kabupaten', '=', 'usulan.kode_kabupaten')
                ->join('kecamatan', 'kecamatan.kode_kecamatan', '=', 'usulan.kode_kecamatan')
                ->select('usulan.*', 'provinsi.provinsi','kabupaten.kabupaten','kecamatan.kecamatan')
                ->where('usulan.user_id',auth()->user()->id)
                ->get();
            }
        }
        return $usulan;
    }
}
