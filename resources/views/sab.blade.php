@extends('layouts.adminlte')

@section('content')
	<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Pembangunan Sarana Air Bersih</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" enctype='multipart/form-data'>
                        {{ csrf_field() }}

                        <b>Bentuk Bantuan  :   Belanja Barang Jalan, Irigasi dan Jaringan Untuk Diserahkan Pada Masyarakat/Pemda</b><br>
                        <b>Sub Bentuk Bantuan  :   Pembangunan Jalan Sirip</b>

                        <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                      <th>#</th>
                                      <th></th>
                                      <th>Ada</th>
                                      <th>Tidak</th>
                                      <th>Keterangan</th>
                                    </tr>
                                    <tr>
                                      <td>1.</td>
                                      <td>Surat Pengantar Proposal Permohonan Bantuan Pemerintah dari Bupati</td>
                                      <td><input type="radio" name="sab_admin_1" value="1"></td>
                                      <td><input type="radio" name="sab_admin_1" value="0"></td>
                                      <td><input type="text" name="sab_admin_1_keterangan"></td>
                                    </tr>
                                    <tr>
                                      <td>2.</td>
                                      <td>Surat Keputusan Bupati tentang Usulan Penetapan Lokasi</td>
                                      <td><input type="radio" name="sab_admin_2" value="1"></td>
                                      <td><input type="radio" name="sab_admin_2" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>
                                    <tr>
                                      <td></td>
                                      <td>- Kecamatan</td>
                                      <td><input type="radio" name="sab_admin_2a" value="1"></td>
                                      <td><input type="radio" name="sab_admin_2a" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>
                                    <tr>
                                      <td></td>
                                      <td>- Desa</td>
                                      <td><input type="radio" name="sab_admin_2b" value="1"></td>
                                      <td><input type="radio" name="sab_admin_2b" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>
                                    <tr>
                                      <td></td>
                                      <td>- Titik Koordinat</td>
                                      <td><input type="radio" name="sab_admin_2c" value="1"></td>
                                      <td><input type="radio" name="sab_admin_2c" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td>3.</td>
                                      <td>Surat Keterangan Pembebasan Lahan</td>
                                      <td><input type="radio" name="sab_admin_3" value="1"></td>
                                      <td><input type="radio" name="sab_admin_3" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>
                                    <tr>
                                      <td>4.</td>
                                      <td>Surat Keputusan Bupati tentang Penunjukan Organisasi Perangkat Daerah (OPD) Teknis</td>
                                      <td><input type="radio" name="sab_admin_4" value="1"></td>
                                      <td><input type="radio" name="sab_admin_4" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>
                                    <tr>
                                      <td>5.</td>
                                      <td>Surat Keputusan Bupati tentang Tim Usulan Tim Pengendali Teknis Bantuan Pemerintah</td>
                                      <td><input type="radio" name="sab_admin_5" value="1"></td>
                                      <td><input type="radio" name="sab_admin_5" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>
                                    <tr>
                                      <td>6.</td>
                                      <td>Surat Pernyataan Bupati bahwa lokasi kegiatan adalah jalan non-status penanganan</td>
                                      <td><input type="radio" name="sab_admin_6" value="1"></td>
                                      <td><input type="radio" name="sab_admin_6" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>
                                    <tr>
                                      <td>7.</td>
                                      <td>Surat Pernyataan Bupati bahwa kegiatan sesuai dengan arah kebijakan pemanfaatan ruang</td>
                                      <td><input type="radio" name="sab_admin_7" value="1"></td>
                                      <td><input type="radio" name="sab_admin_7" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>
                                    <tr>
                                      <td>8.</td>
                                      <td>Surat Pernyataan Bupati tentang kesediaan menerima hibah aset bantuan pemerintah</td>
                                      <td><input type="radio" name="sab_admin_8" value="1"></td>
                                      <td><input type="radio" name="sab_admin_8" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>
                                    <tr>
                                      <td>9.</td>
                                      <td>Surat Pernyataan Bupati mengenai kesanggupan mengelola, memelihara dan mengembangkan aset bantuan pemerintah</td>
                                      <td><input type="radio" name="sab_admin_9" value="1"></td>
                                      <td><input type="radio" name="sab_admin_9" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>


                                    <tr>
                                      <td>1.</td>
                                      <td>Isi Proposal Teknis</td>
                                      <td><input type="radio" name="sab_teknis_1" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_1" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Latar Belakang</td>
                                      <td><input type="radio" name="sab_teknis_1a" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_1a" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Sasaran</td>
                                      <td><input type="radio" name="sab_teknis_1b" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_1b" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Keluaran</td>
                                      <td><input type="radio" name="sab_teknis_1c" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_1c" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Ruang Lingkup</td>
                                      <td><input type="radio" name="sab_teknis_1d" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_1d" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Manfaat (outcome)</td>
                                      <td><input type="radio" name="sab_teknis_1e" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_1e" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Waktu Penyaluran</td>
                                      <td><input type="radio" name="sab_teknis_1f" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_1f" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Jadwal Penyaluran</td>
                                      <td><input type="radio" name="sab_teknis_1g" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_1g" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Lokasi Kegiatan</td>
                                      <td><input type="radio" name="sab_teknis_1h" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_1h" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Rencana Anggaran Biaya</td>
                                      <td><input type="radio" name="sab_teknis_1i" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_1i" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Rencana Pengembangan (yang disetujui dan disahkan oleh pejabat yang berwenang)</td>
                                      <td><input type="radio" name="sab_teknis_1j" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_1j" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td>2.</td>
                                      <td>Kerangka Acuan Kerja (KAK)</td>
                                      <td><input type="radio" name="sab_teknis_2" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_2" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Latar Belakang</td>
                                      <td><input type="radio" name="sab_teknis_2a" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_2a" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Maksud dan Tujuan</td>
                                      <td><input type="radio" name="sab_teknis_2b" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_2b" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Sasaran</td>
                                      <td><input type="radio" name="sab_teknis_2c" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_2c" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Keluaran</td>
                                      <td><input type="radio" name="sab_teknis_2d" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_2d" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Ruang Lingkup</td>
                                      <td><input type="radio" name="sab_teknis_2e" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_2e" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Manfaat (outcome)</td>
                                      <td><input type="radio" name="sab_teknis_2f" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_2f" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Waktu Penyaluran</td>
                                      <td><input type="radio" name="sab_teknis_2g" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_2g" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Lokasi Kegiatan</td>
                                      <td><input type="radio" name="sab_teknis_2h" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_2h" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Manfaat (outcome)</td>
                                      <td><input type="radio" name="sab_teknis_2i" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_2i" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Biaya Penyaluran</td>
                                      <td><input type="radio" name="sab_teknis_2j" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_2j" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Sumber Dana</td>
                                      <td><input type="radio" name="sab_teknis_2k" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_2k" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td>3.</td>
                                      <td>Peta Orientasi Lokasi Bantuan Pemerintah (lokasi yang akan dilakukan pembangunan)</td>
                                      <td><input type="radio" name="sab_teknis_3" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_3" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>


                                    <tr>
                                      <td></td>
                                      <td>- Kecamatan</td>
                                      <td><input type="radio" name="sab_teknis_3a" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_3a" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Desa</td>
                                      <td><input type="radio" name="sab_teknis_3b" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_3b" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Titik Koordinat</td>
                                      <td><input type="radio" name="sab_teknis_3c" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_3c" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td>4.</td>
                                      <td>Spesifikasi Teknis</td>
                                      <td><input type="radio" name="sab_teknis_4" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_4" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td>5.</td>
                                      <td>Gambar Teknis atau Detail Engineering Design (DED) (telah disetujui dan disahkan oleh pejabat yang berwenang)</td>
                                      <td><input type="radio" name="sab_teknis_5" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_5" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td>6.</td>
                                      <td>Dokumen Lingkungan (bila diperlukan)</td>
                                      <td><input type="radio" name="sab_teknis_6" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_6" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td>7.</td>
                                      <td>Analisa Harga Satuan</td>
                                      <td><input type="radio" name="sab_teknis_7" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_7" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td>8.</td>
                                      <td>Standar Biaya Daerah (SBD) dan/atau Standar Biaya Masukan (SBM)</td>
                                      <td><input type="radio" name="sab_teknis_8" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_8" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>
                                    <tr>
                                      <td>9.</td>
                                      <td>Rencana Anggaran Biaya (RAB)</td>
                                      <td><input type="radio" name="sab_teknis_9" value="1"></td>
                                      <td><input type="radio" name="sab_teknis_9" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    
                                 
                                </tbody>
                                </table>
       

                        <div class="form-group">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">
                                    Proses
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection