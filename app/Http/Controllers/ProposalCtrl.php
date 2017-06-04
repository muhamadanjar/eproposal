<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provinsi;
use App\Usulan;
use DB;
use Carbon\Carbon;
use App\SAB;
use App\PLTS;
use App\Jalan;
use App\PJalan;
use App\PSAB;
use App\PPLTS;
use App\User;
use Illuminate\Support\Facades\Log;

use App\Jobs\SendEmail;
use App\Notifications\UsulanUpdated;
use App\Notifications\UsulanAdd;

use App\Traits\SendEmailsEproposal;
use App\Traits\EproposalTraits;
use Illuminate\Support\Facades\Mail;


class ProposalCtrl extends Controller{
    use SendEmailsEproposal,EproposalTraits;
	public function __construct($value='')
	{
		$this->middleware('auth');
        $this->tgl = Carbon::now('Asia/Jakarta');

	}

    public function getArrayUsulan($value=''){
        $usulan = $this->getShowUsulanQuery();

        $array = array('data'=>[]);
        foreach ($usulan as $key => $value) {
            $array['data'][$key] = $value;
            $pjalan = DB::table('usulan_persyaratan_jalan')
                ->join('usulan','usulan.id','usulan_persyaratan_jalan.usulan_id')
                ->join('pjalan','pjalan.id','usulan_persyaratan_jalan.pjalan_id')
                ->select(
                    'usulan.id as UsulID',
                    'pjalan.no',
                    'pjalan.namausulan',
                    'pjalan.tipeusulan',
                    'usulan_persyaratan_jalan.isi',
                    'usulan_persyaratan_jalan.verifikasi',
                    'usulan_persyaratan_jalan.file',
                    'usulan_persyaratan_jalan.keterangan'
                )
                ->orderBy('no','DESC')
                ->where('usulan_persyaratan_jalan.usulan_id',$value->id)
                ->get();
            $psab = DB::table('usulan_persyaratan_sab')
                ->join('usulan','usulan.id','usulan_persyaratan_sab.usulan_id')
                ->join('psab','psab.id','usulan_persyaratan_sab.psab_id')
                ->select(
                    'usulan.id as UsulID',
                    'psab.no',
                    'psab.namausulan',
                    'psab.tipeusulan',
                    'usulan_persyaratan_sab.isi',
                    'usulan_persyaratan_sab.verifikasi',
                    'usulan_persyaratan_sab.file',
                    'usulan_persyaratan_sab.keterangan'
                )
                ->orderBy('no','DESC')
                ->where('usulan_persyaratan_sab.usulan_id',$value->id)
                ->get();
            $pplts = DB::table('usulan_persyaratan_plts')
                ->join('usulan','usulan.id','usulan_persyaratan_plts.usulan_id')
                ->join('pplts','pplts.id','usulan_persyaratan_plts.pplts_id')
                ->select(
                    'usulan.id as UsulID',
                    'pplts.no',
                    'pplts.namausulan',
                    'pplts.tipeusulan',
                    'usulan_persyaratan_plts.isi',
                    'usulan_persyaratan_plts.verifikasi',
                    'usulan_persyaratan_plts.file',
                    'usulan_persyaratan_plts.keterangan'
                )
                ->orderBy('no','DESC')
                ->where('usulan_persyaratan_plts.usulan_id',$value->id)
                ->get();
            $array['data'][$key]['pjalan'] = $pjalan;
            $array['data'][$key]['psab'] = $psab;
            $array['data'][$key]['pplts'] = $pplts;
            $array['data'][$key]['jamterakhir_update'] = $value->updated_at->diffForHumans();
            $array['data'][$key]['jumlah_usulan_juta'] = ($value->jumlah_usulan * 1000000);
            if ($value->jenis_usulan == 1) {
                $array['data'][$key]['usulanpembangunan'] = 'Jalan';
            }elseif($value->jenis_usulan == 2){
                $array['data'][$key]['usulanpembangunan'] = 'SAB';
            }elseif($value->jenis_usulan == 3){
                $array['data'][$key]['usulanpembangunan'] = 'PLTS';
            }else{
                $array['data'][$key]['usulanpembangunan'] = 'Lainnya';
            }
            
        }

        return $array;

    }

    public function getIndex($value=''){
        DB::connection()->enableQueryLog();
    	$this->getArrayUsulan();
        dd(DB::getQueryLog());
    }

    public function getUsulanList($value=''){
        $usulan = Usulan::orderBy('id')->get();
        if (! auth()->user()->hasRole('admin')) {
            $usulan = Usulan::orderBy('id')->where('user_id',auth()->user()->id)->get();
        }
        
        return view('usulanList')->withUsulan($usulan);
    }

    public function getUsulan($value=''){

        if (! $this->authorize('create.usulan')) {
           return "Anda tidak diijinkan menambah usulan :(";
        }
        $provinsi = Provinsi::orderBy('kode_provinsi')->where('isactived',1)->get();
        $c = Carbon::now();
        $jalan = PJalan::orderBy('id','ASC')->get();
        $sab = PSAB::orderBy('id','ASC')->get();
        $plts = PPLTS::orderBy('id','ASC')->get();
        return view('usulan')
            ->withJalan($jalan)
            ->withSab($sab)
            ->withPlts($plts)
            ->withProvinsi($provinsi);
    }

    public function getLihatUsulan($id=''){
        $usulan = $this->getShowUsulanQuery($id);

        $pjalan = DB::table('usulan_persyaratan_jalan')
                ->join('usulan','usulan.id','usulan_persyaratan_jalan.usulan_id')
                ->join('pjalan','pjalan.id','usulan_persyaratan_jalan.pjalan_id')
                ->select(
                    'usulan.id as UsulID',
                    'usulan.user_id as UserID',
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
                    'usulan.user_id as UserID',
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
                    'usulan.user_id as UserID',
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
        $usulan['jumlah_usulan_juta'] = ($usulan->jumlah_usulan * 1000000);
        $usulan['pjalan'] = $pjalan;
        $usulan['psab'] = $psab;
        $usulan['pplts'] = $pplts;

        return view('usulan.lihatUsulan')
            ->withUsulan($usulan);
    }

    public function postUsulan(Request $r){
        
        \DB::beginTransaction();
        try {
            $no_usulan = $r->tahun.$r->jenis_usulan.rand(1,10);
            
            $usulan = new Usulan();
            $usulan->no_usulan = $no_usulan;
            $usulan->kode_provinsi = $r->provinsi;
            $usulan->kode_kabupaten = $r->kabupaten;
            $usulan->kode_kecamatan = $r->kecamatan;
            $usulan->nama_proyek = $r->nama_proyek;
            $usulan->surat_kegiatan = $r->surat_pengantar;
            $usulan->opd_pengusul = $r->skpd_pengusul;
            $usulan->desa = $r->desa;
            $usulan->lat = $r->latitude;
            $usulan->lng = $r->longitude;
            $usulan->jenis_usulan = $r->jenis_usulan;
            //$usulan->penerima_manfaat = $r->penerima_manfaat;
            //$usulan->penerima_manfaat_satuan = $r->penerima_manfaat_satuan;
            $usulan->penerima_manfaat_kk = (double)$r->penerima_manfaat_kk;
            $usulan->penerima_manfaat_jiwa = (double)$r->penerima_manfaat_jiwa;
            $usulan->penerima_manfaat_km = (double)$r->penerima_manfaat_km;
            $usulan->penerima_manfaat_ha = (double)$r->penerima_manfaat_ha;
            $usulan->jumlah_usulan = $r->jumlah_usulan;
            $usulan->tahun_usulan = $r->tahun;
            
            $usulan->user_id = auth()->user()->id;
            if ($r->dokumentasi != null) {
                
                $fupload = $r->file('dokumentasi');
                $vdir_upload ='files';
                $fileName=str_random(20) . '.' . $fupload->getClientOriginalExtension();
                $destinationPath = public_path().'/'.$vdir_upload;
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777);
                } else {
                }
                $fuploadName = $fupload->getClientOriginalName();
                $fupload->move($destinationPath, $fileName);
                $lokasi_file = $destinationPath.'/'.$fileName;
                $usulan->dokumen = $fileName;
            }
            
            if ($usulan->save()) {
                if($r->jenis_usulan == '1'){
                    foreach ($r->pjalanadmin_id as $key => $v) {                
                        $isi = isset($r->jalanadmin[$key]);
                        if ($r->jalanadmin_file_text != null) {
                            $array = ['pjalan_id' => $r->pjalanadmin_id[$key], 
                            'usulan_id' => $usulan->id, 
                            'isi' => $isi,
                            'file' => $r->jalanadmin_file_text[$key]];
                        }else{
                            $array = ['pjalan_id' => $r->pjalanadmin_id[$key], 
                            'usulan_id' => $usulan->id, 
                            'isi' => $isi];
                        }
                        \DB::table('usulan_persyaratan_jalan')
                        ->insert(
                            $array
                        );
                    }
                    foreach ($r->pjalanteknis_id as $key => $v) {
                        $isi = isset($r->jalanteknis[$key]);
                        if ($r->jalanteknis_file_text != null) {
                            $array = ['pjalan_id' => $r->pjalanteknis_id[$key], 
                            'usulan_id' => $usulan->id, 
                            'isi' => $isi,
                            'file' => $r->jalanteknis_file_text[$key]];
                        }else{
                            $array = ['pjalan_id' => $r->pjalanteknis_id[$key], 
                            'usulan_id' => $usulan->id, 
                            'isi' => $isi];
                        }
                        \DB::table('usulan_persyaratan_jalan')
                        ->insert($array);
                    }
                }elseif($r->jenis_usulan == '2'){
                    foreach ($r->psabadmin_id as $key => $v) {   
                        $isi = isset($r->sabadmin[$key]);
                        if ($r->sabadmin_file_text != null) {
                            $array = ['psab_id' => $r->psabadmin_id[$key], 
                            'usulan_id' => $usulan->id, 
                            'isi' => $isi,
                            'file' => $r->sabadmin_file_text[$key]];
                        }else{
                            $array = ['psab_id' => $r->psabadmin_id[$key], 
                            'usulan_id' => $usulan->id, 
                            'isi' => $isi];
                        }          
                        \DB::table('usulan_persyaratan_sab')
                        ->insert($array);
                    }
                    foreach ($r->psabteknis_id as $key => $v) {
                        $isi = isset($r->sabteknis[$key]);
                        if ($r->sabteknis_file_text != null) {
                            $array = ['psab_id' => $r->psabteknis_id[$key], 
                            'usulan_id' => $usulan->id, 
                            'isi' => $isi,
                            'file' => $r->sabteknis_file_text[$key]];
                        }else{
                            $array = ['psab_id' => $r->psabteknis_id[$key], 
                            'usulan_id' => $usulan->id, 
                            'isi' => $isi];
                        }
                        \DB::table('usulan_persyaratan_sab')
                        ->insert($array);
                    }
                }elseif($r->jenis_usulan == '3'){
                    foreach ($r->ppltsadmin_id as $key => $v) {
                        $isi = isset($r->pltsadmin[$key]);
                        if ($r->pltsadmin_file_text != null) {
                            $array = ['pplts_id' => $r->ppltsadmin_id[$key], 
                            'usulan_id' => $usulan->id, 
                            'isi' => $isi,
                            'file' => $r->pltsadmin_file_text[$key]];
                        }else{
                            $array = ['pplts_id' => $r->ppltsadmin_id[$key], 
                            'usulan_id' => $usulan->id, 
                            'isi' => $isi];
                        }       
                        \DB::table('usulan_persyaratan_plts')
                        ->insert($array);
                    }
                    foreach ($r->ppltsteknis_id as $key => $v) {
                        $isi = isset($r->pltsadmin[$key]);
                        if ($r->pltsteknis_file_text != null) {
                            $array = ['pplts_id' => $r->ppltsteknis_id[$key], 
                            'usulan_id' => $usulan->id, 
                            'isi' => $isi,
                            'file'=>$r->pltsteknis_file_text[$key]];
                        }else{
                            $array = ['pplts_id' => $r->ppltsteknis_id[$key], 
                            'usulan_id' => $usulan->id, 
                            'isi' => $isi];
                        }
                        \DB::table('usulan_persyaratan_plts')
                        ->insert($array);
                    }
                }else{

                }
                
            }
            $user = User::findOrFail(2);
            $user->notify(new UsulanAdd($usulan));
                
            //$this->sendEmailAddDataUsulan($usulan->id);

            
            DB::commit();

            $r->session()->flash('Usulanstatus', 'Data Sudah di tampung!');


            
        } catch (Exception $e) {
            \DB::rollback();
            throw $e;
        }

        return redirect('proposal/usulan');
    }

    public function getUbah($id=''){
        $usulan = $this->getShowUsulanQuery($id);
        if ($usulan->status_usulan == 2) {
            session()->flash('Usulanstatus', 'Data Sudah di setujui. Anda tidak dapat merubah data lagi');
            return redirect('pengecekan/usulan');
        }
        $pjalan = DB::table('usulan_persyaratan_jalan')
                ->join('usulan','usulan.id','usulan_persyaratan_jalan.usulan_id')
                ->join('pjalan','pjalan.id','usulan_persyaratan_jalan.pjalan_id')
                ->select(
                    'usulan.id as UsulID',
                    'usulan.user_id as UserID',
                    'pjalan.id as JalanID',
                    'pjalan.no',
                    'pjalan.namausulan',
                    'pjalan.tipeusulan',
                    'usulan_persyaratan_jalan.pjalan_id',
                    'usulan_persyaratan_jalan.isi',
                    'usulan_persyaratan_jalan.file'
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
                    'usulan.user_id as UserID',
                    'psab.id as SabID',
                    'psab.no',
                    'psab.namausulan',
                    'psab.tipeusulan',
                    'usulan_persyaratan_sab.psab_id',
                    'usulan_persyaratan_sab.isi',
                    'usulan_persyaratan_sab.file'
                )
                ->orderBy('no','ASC')
                ->where('usulan_persyaratan_sab.usulan_id',$id)
                ->get();
        $pplts = DB::table('usulan_persyaratan_plts')
                ->join('usulan','usulan.id','usulan_persyaratan_plts.usulan_id')
                ->join('pplts','pplts.id','usulan_persyaratan_plts.pplts_id')
                ->select(
                    'usulan.id as UsulID',
                    'usulan.user_id as UserID',
                    'pplts.id as PltsID',
                    'pplts.no',
                    'pplts.namausulan',
                    'pplts.tipeusulan',
                    'usulan_persyaratan_plts.pplts_id',
                    'usulan_persyaratan_plts.isi',
                    'usulan_persyaratan_plts.file'
                )
                ->orderBy('no','ASC')
                ->where('usulan_persyaratan_plts.usulan_id',$id)
                ->get();

        $usulan['pjalan'] = $pjalan;
        $usulan['psab'] = $psab;
        $usulan['pplts'] = $pplts;



        return view('usulan.usulanEdit')
            ->withJalan($pjalan)
            ->withSab($psab)
            ->withPlts($pplts)
        ->with('usulan',$usulan);
    }

    public function postUbah(Request $r){
        try {
            
        } catch (Exception $e) {
            
        }
        $usulan = Usulan::findOrFail($r->usulan_id);
        $usulan->jumlah_usulan = $r->jumlah_usulan;
        $usulan->lat = $r->latitude;
        $usulan->lng = $r->longitude;
        $usulan->penerima_manfaat_kk = (double)$r->penerima_manfaat_kk;
        $usulan->penerima_manfaat_jiwa = (double)$r->penerima_manfaat_jiwa;
        $usulan->penerima_manfaat_km = (double)$r->penerima_manfaat_km;
        $usulan->penerima_manfaat_ha = (double)$r->penerima_manfaat_ha;
        $usulan->save();
        
        if($r->jenis_usulan == '1'){
            foreach ($r->pjalanadmin_id as $key => $v) {
                if ($r->jalanadmin_file_text != null) {
                    $array = [
                        'pjalan_id' => $r->pjalanadmin_id[$key], 
                        'usulan_id' => $r->usulan_id, 
                        'isi' => $r->jalanadmin[$key],
                        'file' => $r->jalanadmin_file_text[$key]
                        ];
                }else{
                    $array = [
                        'pjalan_id' => $r->pjalanadmin_id[$key], 
                        'usulan_id' => $r->usulan_id, 
                        'isi' => $r->jalanadmin[$key]
                        ];
                }
                 
                \DB::table('usulan_persyaratan_jalan')
                ->where('pjalan_id',$r->pjalanadmin_id[$key])
                ->where('usulan_id',$r->usulan_id)
                    ->update(
                        $array
                    );
            }
            foreach ($r->pjalanteknis_id as $key => $v) {
                if ($r->jalanteknis_file_text[$key] != null) {
                    $array = [
                        'pjalan_id' => $r->pjalanteknis_id[$key], 
                        'usulan_id' => $r->usulan_id, 
                        'isi' => $r->jalanteknis[$key],
                        'file' => $r->jalanteknis_file_text[$key]
                        ];
                }else{
                    $array = [
                        'pjalan_id' => $r->pjalanteknis_id[$key], 
                        'usulan_id' => $r->usulan_id, 
                        'isi' => $r->jalanteknis[$key]
                        ];
                }
                \DB::table('usulan_persyaratan_jalan')
                ->where('pjalan_id',$r->pjalanteknis_id[$key])
                ->where('usulan_id',$r->usulan_id)
                    ->update(
                        $array
                    );
            }
        }elseif($r->jenis_usulan == '2'){
            foreach ($r->psabadmin_id as $key => $v) {
                if ($r->sabadmin_file_text[$key] != null) {
                    $array = array(
                        'psab_id' => $r->psabadmin_id[$key], 
                        'usulan_id' => $r->usulan_id, 
                        'isi' => $r->sabadmin[$key],
                        'file' => $r->sabadmin_file_text[$key]
                    );
                }else{
                    $array = array(
                            'psab_id' => $r->psabadmin_id[$key], 
                            'usulan_id' => $r->usulan_id, 
                            'isi' => $r->sabadmin[$key]
                    );
                } 
                \DB::table('usulan_persyaratan_sab')
                ->where('psab_id',$r->psabadmin_id[$key])
                ->where('usulan_id',$r->usulan_id)
                    ->update($array);
            }
            foreach ($r->psabteknis_id as $key => $v) {
                if ($r->sabteknis_file_text[$key] != null) {
                    $array = array(
                        'psab_id' => $r->psabteknis_id[$key], 
                        'usulan_id' => $r->usulan_id, 
                        'isi' => $r->sabteknis[$key],
                        'file' => $r->sabteknis_file_text[$key]
                    );
                }else{
                    $array = array(
                        'psab_id' => $r->psabteknis_id[$key], 
                        'usulan_id' => $r->usulan_id, 
                        'isi' => $r->sabteknis[$key]
                    );
                } 
                \DB::table('usulan_persyaratan_sab')
                ->where('psab_id',$r->psabteknis_id[$key])
                ->where('usulan_id',$r->usulan_id)
                    ->update($array);
            }
        }elseif($r->jenis_usulan == '3'){
            foreach ($r->ppltsadmin_id as $key => $v) {
                
                if ($r->pltsadmin_file_text != null) {
                        $array = array(
                            'pplts_id' => $r->ppltsadmin_id[$key], 
                            'usulan_id' => $r->usulan_id, 
                            'isi' => $r->pltsadmin[$key],
                            'file' => $r->pltsadmin_file_text[$key]
                            );
                }else{
                        $array = array(
                            'pplts_id' => $r->ppltsadmin_id[$key], 
                            'usulan_id' => $r->usulan_id, 
                            'isi' => $r->pltsadmin[$key],
                            );
                }
                
                \DB::table('usulan_persyaratan_plts')
                ->where('pplts_id',$r->ppltsadmin_id[$key])
                ->where('usulan_id',$r->usulan_id)
                    ->update($array);
            }
            foreach ($r->ppltsteknis_id as $key => $v) {
                    
                    if ($r->pltsteknis_file_text != null) {
                        $array = [
                            'pplts_id' => $r->ppltsteknis_id[$key], 
                            'usulan_id' => $r->usulan_id, 
                            'isi' => $r->pltsteknis[$key],
                            'file' => $r->pltsteknis_file_text[$key]
                            ];
                    }else{
                        $array = [
                            'pplts_id' => $r->ppltsteknis_id[$key], 
                            'usulan_id' => $r->usulan_id, 
                            'isi' => $r->pltsteknis[$key]
                            ];
                    }
                
                    \DB::table('usulan_persyaratan_plts')
                    ->where('pplts_id',$r->ppltsteknis_id[$key])
                    ->where('usulan_id',$r->usulan_id)
                        ->update(
                            $array
                        );
            }
        }


        $user = User::findOrFail(2);
        $user->notify(new UsulanUpdated($usulan));
        
        //$this->sendEmailUpdateDataUsulan($r->usulan_id);

        return redirect('proposal/usulan');
    }

    public function postUpload(){
        $dir = public_path('files')."/";
        if(!is_dir($dir))
                mkdir($dir);
                $ext = pathinfo($_FILES["images"]["name"],PATHINFO_EXTENSION);
                $filename = time().'_'.urlencode(pathinfo($_FILES["images"]["name"],PATHINFO_FILENAME)).'.'.$ext;
                if(move_uploaded_file($_FILES["images"]["tmp_name"], $dir. $filename)){
                    
                    echo json_encode(array(
                        'error'=>false,
                        'filename'=>$filename,
                        'data'=>$_FILES["images"]
                        ));
                    exit;
                }
        echo json_encode(array('error'=>true,'message'=>'Upload process error'));
        exit;
    }

    public function postUploadDokumentasi(){
        $dir = public_path('files')."/";
        if(!is_dir($dir))
                mkdir($dir);
                $ext = pathinfo($_FILES["images"]["name"],PATHINFO_EXTENSION);
                $filename = time().'_'.urlencode(pathinfo($_FILES["images"]["name"],PATHINFO_FILENAME)).'.'.$ext;
                if(move_uploaded_file($_FILES["images"]["tmp_name"], $dir. $filename)){
                    session()->pull('dokumentasifile', $filename);
                    echo json_encode(array(
                        'error'=>false,
                        'filename'=>$filename,
                        'data'=>$_FILES["images"]
                        ));
                    exit;
                }
        echo json_encode(array('error'=>true,'message'=>'Upload process error'));
        exit;
    }

    public function sendEmail($data){

        $this->dispatch(new SendEmail($data));
        //return new SendEmail($data);


    }

  

    
}
