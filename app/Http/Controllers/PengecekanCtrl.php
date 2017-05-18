<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usulan;
use DB;
use App\Http\Controllers\ProposalCtrl;
use App\Traits\SendEmailsEproposal;
class PengecekanCtrl extends Controller
{
    use SendEmailsEproposal;
    public function __construct($value=''){
        $this->middleware('auth');
        $this->PC = new ProposalCtrl();
    }
   	public function getIndex(){
   	 	return view('usulan.pengecekanUsulanList');
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

   	public function getUsulan($id=''){
   		
      $usulan = $this->getShowUsulanQuery($id);
      if ($usulan->status_usulan == 2) {
          session()->flash('Usulanstatus', 'Data Sudah di setujui');
          return redirect('pengecekan/usulan');
      }
      $pjalan = DB::table('usulan_persyaratan_jalan')
                ->join('usulan','usulan.id','usulan_persyaratan_jalan.usulan_id')
                ->join('pjalan','pjalan.id','usulan_persyaratan_jalan.pjalan_id')
                ->select(
                    'usulan.id as UsulID',
                    'pjalan.id as JalanID',
                    'pjalan.no',
                    'pjalan.namausulan',
                    'pjalan.tipeusulan',
                    'usulan_persyaratan_jalan.pjalan_id',
                    'usulan_persyaratan_jalan.isi',
                    'usulan_persyaratan_jalan.file',
                    'usulan_persyaratan_jalan.verifikasi',
                    'usulan_persyaratan_jalan.keterangan'
                )
                ->orderBy('tipeusulan','ASC')
                ->orderBy('no','ASC')
                ->where('usulan_persyaratan_jalan.usulan_id',$id)
                ->get();
      $psab = DB::table('usulan_persyaratan_sab')
                ->join('usulan','usulan.id','usulan_persyaratan_sab.usulan_id')
                ->join('psab','psab.id','usulan_persyaratan_sab.psab_id')
                ->select(
                    'usulan.id as UsulID',
                    'psab.id as SabID',
                    'psab.no',
                    'psab.namausulan',
                    'psab.tipeusulan',
                    'usulan_persyaratan_sab.psab_id',
                    'usulan_persyaratan_sab.isi',
                    'usulan_persyaratan_sab.file',
                    'usulan_persyaratan_sab.verifikasi',
                    'usulan_persyaratan_sab.keterangan'
                )
                ->orderBy('tipeusulan','ASC')
                ->orderBy('no','ASC')
                ->where('usulan_persyaratan_sab.usulan_id',$id)
                ->get();
      $pplts = DB::table('usulan_persyaratan_plts')
                ->join('usulan','usulan.id','usulan_persyaratan_plts.usulan_id')
                ->join('pplts','pplts.id','usulan_persyaratan_plts.pplts_id')
                ->select(
                    'usulan.id as UsulID',
                    'pplts.id as PltsID',
                    'pplts.no',
                    'pplts.namausulan',
                    'pplts.tipeusulan',
                    'usulan_persyaratan_plts.pplts_id',
                    'usulan_persyaratan_plts.isi',
                    'usulan_persyaratan_plts.file',
                    'usulan_persyaratan_plts.verifikasi',
                    'usulan_persyaratan_plts.keterangan'
                )
                ->orderBy('tipeusulan','ASC')
                ->orderBy('no','ASC')
                ->where('usulan_persyaratan_plts.usulan_id',$id)
                ->get();
      $usulan['pjalan'] = $pjalan;
      $usulan['psab'] = $psab;
      $usulan['pplts'] = $pplts;
      $jenis_usulan = DB::table('jenis_usulan')->where('id',$usulan->jenis_usulan)->first();
      if ($jenis_usulan->name == 'jalan' ) {
          $_jenis = 'Jalan Sirip';
      }elseif ($jenis_usulan->name == 'sab') {
          $_jenis = 'SAB';
      }elseif ($jenis_usulan->name == 'plts') {
          $_jenis = 'PLTS';
      }else{
          $_jenis = 'Lainnya';
      }

      
   		return view('usulan.pengecekanUsulan')
        ->with('jenis',$_jenis)
        ->withUsulan($usulan);
   	}

    public function postUsulan(Request $r){
      
      $usulan = Usulan::find($r->usulan_id);
      $usulan->status_usulan = $r->status;
      $usulan->save();
      if($r->jenis_usulan == '1'){
          foreach ($r->pjalan_id as $key => $id) {
              $ver = isset($r->verifikasi[$key]);
              \DB::table('usulan_persyaratan_jalan')
                ->where('pjalan_id',$id)
                ->where('usulan_id',$r->usulan_id)
                        ->update([
                          'verifikasi' => $ver,
                          'keterangan' => $r->keterangan[$key],
                        ]);
          }   
      }elseif($r->jenis_usulan == '2'){
          foreach ($r->psab_id as $key => $v) {
              $ver = isset($r->verifikasi[$key]);            
              \DB::table('usulan_persyaratan_sab')
                ->where('psab_id',$v)
                ->where('usulan_id',$r->usulan_id)
                        ->update([
                            'verifikasi' => $ver,
                            'keterangan' => $r->keterangan[$key],
                        ]);
          }
          
      }elseif($r->jenis_usulan == '3'){
          foreach ($r->pplts_id as $key => $v) {
            $ver = isset($r->verifikasi[$key]);        
              \DB::table('usulan_persyaratan_plts')
                ->where('pplts_id',$v)
                ->where('usulan_id',$r->usulan_id)
                        ->update([
                            'verifikasi' => $ver,
                            'keterangan' => $r->keterangan[$key],
                        ]);
          }
      }
      if($usulan->status_usulan == 2){
        $this->sendEmailUsulanDisetujui($usulan->id);  
      }
      

      return redirect('pengecekan/usulan');
    }
}
