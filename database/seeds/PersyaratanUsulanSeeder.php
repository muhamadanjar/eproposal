<?php

use Illuminate\Database\Seeder;

class PersyaratanUsulanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('jenis_usulan')->insert([
            ['name'=>'jalan'],
            ['name'=>'sab'],
            ['name'=>'plts'],
            ['name'=>'lainnya']
        ]);
        $this->jalanadmin();
        $this->jalanteknis();

        $this->sabadmin();
        $this->sabteknis();

        $this->pltsadmin();
        $this->pltsteknis();
    }


    public function jalanadmin(){
    	DB::table('pjalan')->insert([
            [
            'no' => 1,
            'slugusulan'=>'jalan_admin_1',
            'namausulan' => 'Surat Pengantar Proposal Permohonan Bantuan Pemerintah dari Bupati',
            'tipeusulan' => 'admin'
            ],

            [
            'no' => 2,
            'slugusulan'=>'jalan_admin_2',
            'namausulan' => 'Surat Keputusan Bupati tentang Usulan Penetapan Lokasi',
            'tipeusulan' => 'admin'
            ],

            /*[
            'no' => 3,
            'slugusulan'=>'jalan_admin_3',
            'namausulan' => 'Surat Keterangan Pembebasan Lahan',
            'tipeusulan' => 'admin'
            ],*/

            [
            'no' => 3,
            'slugusulan'=>'jalan_admin_4',
            'namausulan' => 'Surat Keputusan Bupati tentang Penunjukan Organisasi Perangkat Daerah (OPD) Teknis',
            'tipeusulan' => 'admin'
            ],

            /*[
            'no' => 5,
            'slugusulan'=>'jalan_admin_5',
            'namausulan' => 'Surat Keputusan Bupati tentang Tim Usulan Tim Pengendali Teknis Bantuan Pemerintah',
            'tipeusulan' => 'admin'
            ],*/

            /*[
            'no' => 6,
            'slugusulan'=>'jalan_admin_6',
            'namausulan' => 'Surat Pernyataan Bupati bahwa lokasi kegiatan adalah jalan non-status belum pernah dilakukan penanganan',
            'tipeusulan' => 'admin'
            ],

            [
            'no' => 7,
            'slugusulan'=>'jalan_admin_7',
            'namausulan' => 'Surat Pernyataan Bupati bahwa kegiatan sesuai dengan arah kebijakan pemanfaatan ruang',
            'tipeusulan' => 'admin'
            ],*/

            /*[
            'no' => 8,
            'slugusulan'=>'jalan_admin_8',
            'namausulan' => 'Surat Pernyataan Bupati tentang kesediaan menerima hibah aset bantuan pemerintah',
            'tipeusulan' => 'admin'
            ],*/

            /*[
            'no' => 9,
            'slugusulan'=>'jalan_admin_9',
            'namausulan' => 'Surat Pernyataan Bupati mengenai kesanggupan mengelola, memelihara dan mengembangkan aset bantuan pemerintah',
            'tipeusulan' => 'admin'
            ],*/
            
        ]);
    }

    public function jalanteknis(){
    	DB::table('pjalan')->insert([
            [
            'no' => 1,
            'slugusulan'=>'jalan_teknis_1',
            'namausulan' => 'Isi Proposal Teknis',
            'tipeusulan' => 'teknis'
            ],

            /*[
            'no' => 2,
            'slugusulan'=>'jalan_teknis_2',
            'namausulan' => 'Kerangka Acuan Kerja (KAK)',
            'tipeusulan' => 'teknis'
            ],*/

            [
            'no' => 2,
            'slugusulan'=>'jalan_teknis_3',
            'namausulan' => 'Peta Orientasi Lokasi Bantuan Pemerintah (lokasi yang akan dilakukan pembangunan)',
            'tipeusulan' => 'teknis'
            ],

            /*[
            'no' => 4,
            'slugusulan'=>'jalan_teknis_4',
            'namausulan' => 'Spesifikasi Teknis',
            'tipeusulan' => 'teknis'
            ],*/

            [
            'no' => 3,
            'slugusulan'=>'jalan_teknis_5',
            'namausulan' => 'Gambar Teknis atau Detail Engineering Design (DED) (telah disetujui dan disahkan oleh pejabat yang berwenang)',
            'tipeusulan' => 'teknis'
            ],

            [
            'no' => 4,
            'slugusulan'=>'jalan_teknis_6',
            'namausulan' => 'Analisa Harga Satuan',
            'tipeusulan' => 'teknis'
            ],

            [
            'no' => 5,
            'slugusulan'=>'jalan_teknis_7',
            'namausulan' => 'Standar Biaya Daerah (SBD) dan/atau Standar Biaya Masukan (SBM)',
            'tipeusulan' => 'teknis'
            ],

            [
            'no' => 6,
            'slugusulan'=>'jalan_teknis_8',
            'namausulan' => 'Rencana Anggaran Biaya (RAB)',
            'tipeusulan' => 'teknis'
            ],
 
        ]);
    }

    public function sabadmin(){
        DB::table('psab')->insert([
            [
            'no' => 1,
            'slugusulan'=>'sab_admin_1',
            'namausulan' => 'Surat Pengantar Proposal Permohonan Bantuan Pemerintah dari Bupati yang ditujukan kepada Menteri Desa, Pembangunan Daerah Tertinggal dan Transmigrasi',
            'tipeusulan' => 'admin'
            ],

            [
            'no' => 2,
            'slugusulan'=>'sab_admin_2',
            'namausulan' => 'Surat Keputusan Bupati Tentang Usulan Penetapan Lokasi.',
            'tipeusulan' => 'admin'
            ],

            [
            'no' => 3,
            'slugusulan'=>'sab_admin_3',
            'namausulan' => 'Surat Keputusan Bupati tentang Penunjukan Organisasi Perangkat Daerah (OPD) Teknis',
            'tipeusulan' => 'admin'
            ],
        ]);
    }

    public function sabteknis(){
        DB::table('psab')->insert([
            [
            'no' => 1,
            'slugusulan'=>'sab_teknis_1',
            'namausulan' => 'Isi Proposal Teknis',
            'tipeusulan' => 'teknis'
            ],

            [
            'no' => 2,
            'slugusulan'=>'sab_teknis_2',
            'namausulan' => 'Peta orientasi lokasi bantuan pemerintah yang akan dilakukan pembangunan',
            'tipeusulan' => 'teknis'
            ],

            [
            'no' => 3,
            'slugusulan'=>'sab_teknis_3',
            'namausulan' => 'Gambar Teknis atau Detail Enginering Design (DED)',
            'tipeusulan' => 'teknis'
            ],

            [
            'no' => 4,
            'slugusulan'=>'sab_teknis_4',
            'namausulan' => 'Dokumen Lingkungan',
            'tipeusulan' => 'teknis'
            ],

            [
            'no' => 5,
            'slugusulan'=>'sab_teknis_5',
            'namausulan' => 'Analisa Harga Satuan',
            'tipeusulan' => 'teknis'
            ],

            [
            'no' => 6,
            'slugusulan'=>'sab_teknis_6',
            'namausulan' => 'Standar Biaya Daerah (SBD),',
            'tipeusulan' => 'teknis'
            ],

            [
            'no' => 7,
            'slugusulan'=>'sab_teknis_7',
            'namausulan' => 'Rencana Anggaran Biaya (RAB),',
            'tipeusulan' => 'teknis'
            ],

        ]);
    }

    public function pltsadmin($value=''){
        DB::table('pplts')->insert([
            [
            'no' => 1,
            'slugusulan'=>'plts_admin_1',
            'namausulan' => 'Surat Pengantar Proposal Permohonan',
            'tipeusulan' => 'admin'
            ],

            [
            'no' => 2,
            'slugusulan'=>'plts_admin_2',
            'namausulan' => 'Surat Keputusan Bupati Tentang Usulan Penetapan Lokasi',
            'tipeusulan' => 'admin'
            ],

            [
            'no' => 3,
            'slugusulan'=>'plts_admin_3',
            'namausulan' => 'Surat Keputusan Bupati tentang Penunjukan Organisasi Perangkat Daerah (OPD)',
            'tipeusulan' => 'admin'
            ],

          
        ]);
    }

    public function pltsteknis($value=''){
        DB::table('pplts')->insert([
            [
            'no' => 1,
            'slugusulan'=>'plts_teknis_1',
            'namausulan' => 'Surat Pengantar Proposal Permohonan',
            'tipeusulan' => 'teknis'
            ],
            [
            'no' => 2,
            'slugusulan'=>'plts_teknis_2',
            'namausulan' => 'Peta/denah lokasi',
            'tipeusulan' => 'teknis'
            ],
            [
            'no' => 3,
            'slugusulan'=>'plts_teknis_3',
            'namausulan' => 'Dokumen Lingkungan',
            'tipeusulan' => 'teknis'
            ],
            [
            'no' => 4,
            'slugusulan'=>'plts_teknis_4',
            'namausulan' => 'Analisa Harga',
            'tipeusulan' => 'teknis'
            ],

            [
            'no' => 5,
            'slugusulan'=>'plts_teknis_5',
            'namausulan' => 'Standar Biaya Daerah (SBD)',
            'tipeusulan' => 'teknis'
            ],

            [
            'no' => 6,
            'slugusulan'=>'plts_teknis_6',
            'namausulan' => 'Rencana Anggaran Biaya (RAB),',
            'tipeusulan' => 'teknis'
            ],

            
        ]);
    }
}
