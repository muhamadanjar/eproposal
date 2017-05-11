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

class ProposalCtrl extends Controller
{
	public function __construct($value='')
	{
		$this->middleware('auth');
        $this->tgl = Carbon::now('Asia/Jakarta');
	}

    public function getArrayUsulan($value=''){
        $usulan = Usulan::join('provinsi', 'provinsi.kode_provinsi', '=', 'usulan.kode_provinsi')
        ->join('kabupaten', 'kabupaten.kode_kabupaten', '=', 'usulan.kode_kabupaten')
        ->join('kecamatan', 'kecamatan.kode_kecamatan', '=', 'usulan.kode_kecamatan')
        ->select('usulan.*', 'provinsi.provinsi','kabupaten.kabupaten','kecamatan.kecamatan')
        ->get();
        
        $array = array();
        foreach ($usulan as $key => $value) {
            $array['data'][$key] = $value;
            /*$array['data'][$key]['jalan'] = $value->jalan;
            $array['data'][$key]['sab'] = $value->sab;
            $array['data'][$key]['plts'] = $value->plts;*/

            //$array['data'][$key]['pjalan'] = $value->pjalan;
            $pjalan = DB::table('usulan_persyaratan_jalan')
                ->join('usulan','usulan.id','usulan_persyaratan_jalan.usulan_id')
                ->join('pjalan','pjalan.id','usulan_persyaratan_jalan.pjalan_id')
                ->select(
                    'usulan.id as UsulID',
                    'pjalan.no',
                    'pjalan.namausulan',
                    'pjalan.tipeusulan',
                    'usulan_persyaratan_jalan.isi',
                    'usulan_persyaratan_jalan.file'
                )
                ->orderBy('no','DESC')
                ->where('usulan_persyaratan_jalan.usulan_id',$value->id)
                ->get();
            $array['data'][$key]['pjalan'] = $pjalan;

            

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
        $provinsi = Provinsi::orderBy('kode_provinsi')->get();
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

    public function postUsulan(Request $r){

        
        \DB::beginTransaction();
        try {
            
            $usulan = new Usulan();
            $usulan->kode_provinsi = $r->provinsi;
            $usulan->kode_kabupaten = $r->kabupaten;
            $usulan->kode_kecamatan = $r->kecamatan;
            $usulan->skpd_pengusul = $r->skpd_pengusul;
            $usulan->desa = $r->desa;
            $usulan->lat = $r->latitude;
            $usulan->lng = $r->longitude;
            $usulan->jenis_usulan = $r->jenis_usulan;
            $usulan->penerima_manfaat = $r->penerima_manfaat;
            $usulan->penerima_manfaat_satuan = $r->penerima_manfaat_satuan;
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
                        \DB::table('usulan_persyaratan_jalan')
                        ->insert(
                            ['pjalan_id' => $r->pjalanadmin_id[$key], 
                            'usulan_id' => $usulan->id, 
                            'isi' => $r->jalanadmin[$key]]
                        );
                    }
                    foreach ($r->pjalanteknis_id as $key => $v) {
                        
                        \DB::table('usulan_persyaratan_jalan')
                        ->insert(
                            ['pjalan_id' => $r->pjalanteknis_id[$key], 
                            'usulan_id' => $usulan->id, 
                            'isi' => $r->jalanteknis[$key]]
                        );
                    }
                }elseif($r->jenis_usulan == '2'){
                    foreach ($r->psabadmin_id as $key => $v) {                
                        \DB::table('usulan_persyaratan_sab')
                        ->insert(
                            ['psab_id' => $r->psabadmin_id[$key], 
                            'usulan_id' => $usulan->id, 
                            'isi' => $r->sabadmin[$key]]
                        );
                    }
                    foreach ($r->psabteknis_id as $key => $v) {
                        
                        \DB::table('usulan_persyaratan_sab')
                        ->insert(
                            ['psab_id' => $r->psabteknis_id[$key], 
                            'usulan_id' => $usulan->id, 
                            'isi' => $r->sabteknis[$key]]
                        );
                    }
                }elseif($r->jenis_usulan == '3'){
                    foreach ($r->ppltsadmin_id as $key => $v) {                
                        \DB::table('usulan_persyaratan_plts')
                        ->insert(
                            ['pplts_id' => $r->ppltsadmin_id[$key], 
                            'usulan_id' => $usulan->id, 
                            'isi' => $r->pltsadmin[$key]]
                        );
                    }
                    foreach ($r->ppltsteknis_id as $key => $v) {
                        
                        \DB::table('usulan_persyaratan_plts')
                        ->insert(
                            ['pplts_id' => $r->ppltsteknis_id[$key], 
                            'usulan_id' => $usulan->id, 
                            'isi' => $r->pltsteknis[$key]]
                        );
                    }
                }else{

                }
                
            }
            

            /*if($r->jenis_usulan == '1') {
                $proyek = new Jalan();
                $proyek->jalan_admin_1 = $r->jalan_admin_1;
                $proyek->jalan_admin_1_file = $r->jalan_admin_1_file;
                $proyek->jalan_admin_2 = $r->jalan_admin_2;
                $proyek->jalan_admin_3 = $r->jalan_admin_3;
                $proyek->jalan_admin_4 = $r->jalan_admin_4;
                $proyek->jalan_admin_5 = $r->jalan_admin_5;
                $proyek->jalan_admin_6 = $r->jalan_admin_6;
                $proyek->jalan_admin_7 = $r->jalan_admin_7;
                $proyek->jalan_admin_8 = $r->jalan_admin_8;
                $proyek->jalan_admin_9 = $r->jalan_admin_9;

                $proyek->jalan_teknis_1 = $r->jalan_teknis_1;
                $proyek->jalan_teknis_2 = $r->jalan_teknis_2;
                $proyek->jalan_teknis_2 = $r->jalan_teknis_2;
                $proyek->jalan_teknis_3 = $r->jalan_teknis_3;
                $proyek->jalan_teknis_4 = $r->jalan_teknis_4;
                $proyek->jalan_teknis_5 = $r->jalan_teknis_5;
                $proyek->jalan_teknis_6 = $r->jalan_teknis_6;

                $proyek->status = 0;
                $proyek->user_id = auth()->user()->id;
                $proyek->usulan_id = $usulan->id;
                $proyek->save();
            }elseif($r->jenis_usulan == '2'){
                $proyek = new SAB();
                $proyek->sab_admin_1 = $r->sab_admin_1;
                //$proyek->sab_admin_1_file = $r->sab_admin_1_file;
                $proyek->sab_admin_2 = $r->sab_admin_2;
                $proyek->sab_admin_3 = $r->sab_admin_3;
                $proyek->sab_admin_4 = $r->sab_admin_4;
                $proyek->sab_admin_5 = $r->sab_admin_5;
                $proyek->sab_admin_6 = $r->sab_admin_6;
                $proyek->sab_admin_7 = $r->sab_admin_7;
                $proyek->sab_admin_8 = $r->sab_admin_8;
                $proyek->sab_admin_9 = $r->sab_admin_9;

                $proyek->sab_teknis_1 = $r->sab_teknis_1;
                $proyek->sab_teknis_2 = $r->sab_teknis_2;
                $proyek->sab_teknis_2 = $r->sab_teknis_2;
                $proyek->sab_teknis_3 = $r->sab_teknis_3;
                $proyek->sab_teknis_4 = $r->sab_teknis_4;
                $proyek->sab_teknis_5 = $r->sab_teknis_5;
                $proyek->sab_teknis_6 = $r->sab_teknis_6;
                $proyek->sab_teknis_7 = $r->sab_teknis_7;
                $proyek->sab_teknis_8 = $r->sab_teknis_8;
                $proyek->sab_teknis_9 = $r->sab_teknis_9;

                $proyek->status = 0;
                $proyek->user_id = auth()->user()->id;
                $proyek->usulan_id = $usulan->id;
                $proyek->save();
            }elseif($r->jenis_usulan == '3'){
                $proyek = new PLTS();
                $proyek->plts_admin_1 = $r->plts_admin_1;
                $proyek->plts_admin_1_file = $r->plts_admin_1_file;
                $proyek->plts_admin_2 = $r->plts_admin_2;
                $proyek->plts_admin_3 = $r->plts_admin_3;
                $proyek->plts_admin_4 = $r->plts_admin_4;
                $proyek->plts_admin_5 = $r->plts_admin_5;
                $proyek->plts_admin_6 = $r->plts_admin_6;
                $proyek->plts_admin_7 = $r->plts_admin_7;
                $proyek->plts_admin_8 = $r->plts_admin_8;
                $proyek->plts_admin_9 = $r->plts_admin_9;

                $proyek->plts_teknis_1 = $r->plts_teknis_1;
                $proyek->plts_teknis_2 = $r->plts_teknis_2;
                $proyek->plts_teknis_2 = $r->plts_teknis_2;
                $proyek->plts_teknis_3 = $r->plts_teknis_3;
                $proyek->plts_teknis_4 = $r->plts_teknis_4;
                $proyek->plts_teknis_5 = $r->plts_teknis_5;
                $proyek->plts_teknis_6 = $r->plts_teknis_6;
                $proyek->plts_teknis_7 = $r->plts_teknis_7;
                
                $proyek->status = 0;
                $proyek->user_id = auth()->user()->id;
                $proyek->usulan_id = $usulan->id;
                $proyek->save();
            }*/
            DB::commit();

            $r->session()->flash('Usulanstatus', 'Data Sudah di tampung!');
            
        } catch (Exception $e) {
            \DB::rollback();
            throw $e;
        }

        return redirect('proposal/usulan');
    }

    public function getPeriksaDokumen($value=''){
        $arrayJ = array();
        $jalan_admin_1 = array('key'=>'jalan_admin_1');

        array_push($arrayJ, $jalan_admin_1);

        $array = [
            ['label'=>'Surat Pengantar Proposal Permohonan Bantuan Pemerintah dari Bupati','key'=>'jalan_admin_1'],
            ['label'=>'Surat Keputusan Bupati tentang Usulan Penetapan Lokasi','key'=>'jalan_admin_2'],
            ['label'=>'Surat Keterangan Pembebasan Lahan','key'=>'jalan_admin_3'],
            ['label'=>'Surat Keputusan Bupati tentang Penunjukan Organisasi Perangkat Daerah (OPD) Teknis','key'=>'jalan_admin_4'],
            ['label'=>'Surat Keputusan Bupati tentang Tim Usulan Tim Pengendali Teknis Bantuan Pemerintah','key'=>'jalan_admin_5'],
            ['label'=>'Surat Pernyataan Bupati bahwa lokasi kegiatan adalah jalan non-status belum pernah dilakukan penanganan','key'=>'jalan_admin_6'],
            ['label'=>'Surat Pernyataan Bupati bahwa kegiatan sesuai dengan arah kebijakan pemanfaatan ruang','key'=>'jalan_admin_7'],
            ['label'=>'Surat Pernyataan Bupati tentang kesediaan menerima hibah aset bantuan pemerintah','key'=>'jalan_admin_8'],
            ['label'=>'Surat Pernyataan Bupati mengenai kesanggupan mengelola, memelihara dan mengembangkan aset bantuan pemerintah','key'=>'jalan_admin_9'],

            ['label'=>'Isi Proposal Teknis','key'=>'jalan_teknis_1'],
            ['label'=>'Kerangka Acuan Kerja (KAK)','key'=>'jalan_teknis_2'],
            ['label'=>'Peta Orientasi Lokasi Bantuan Pemerintah (lokasi yang akan dilakukan pembangunan)','key'=>'jalan_teknis_3'],
            ['label'=>'Spesifikasi Teknis','key'=>'jalan_teknis_4'],
            ['label'=>'Gambar Teknis atau Detail Engineering Design (DED) (telah disetujui dan disahkan oleh pejabat yang berwenang)','key'=>'jalan_teknis_5'],
            ['label'=>'Analisa Harga Satuan','key'=>'jalan_teknis_6'],
            ['label'=>'Standar Biaya Daerah (SBD) dan/atau Standar Biaya Masukan (SBM)','key'=>'jalan_teknis_7'],
            ['label'=>'Rencana Anggaran Biaya (RAB)','key'=>'jalan_teknis_8'],
            
        ];

    	return view('periksa_dokumen')->with('jalan_array',($array));
    }

    
}
