@extends('layouts.app')

@section('content')


    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">PERSYARATAN BANTUAN PEMERINTAH</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" enctype='multipart/form-data'>
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('provinsi') ? ' has-error' : '' }}">
                            <label for="provinsi" class="col-md-4 control-label">Provinsi</label>
                            <div class="col-md-6">
                                <select name="provinsi" id="provinsi" class="form-control chosen-select">
                                    <option value="--">----</option>
                                    @foreach($provinsi as $k => $v)
                                        <option value="{{ $v->kode_provinsi }}">{{$v->provinsi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('kabupaten') ? ' has-error' : '' }}">
                            <label for="kabupaten" class="col-md-4 control-label">Kabupaten/Kota</label>

                            <div class="col-md-6">
                                <select name="kabupaten" id="kabkota" class="form-control"></select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('skpd_pengusul') ? ' has-error' : '' }}">
                            <label for="kordinat" class="col-md-4 control-label">SKPD Pengusul</label>
                            <div class="col-md-6">
                                <input type="text" name="skpd_pengusul" class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('pembangunan') ? ' has-error' : '' }}">
                            <label for="pembangunan" class="col-md-4 control-label">Pembangunan</label>

                            <div class="col-md-6">
                                <select name="pembangunan" id="pembangunan" class="form-control">
                                  <option value="jalan">Jalan Sirip</option>
                                  <option value="sab">SAB</option>
                                  <option value="plts">PLTS</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('desa') ? ' has-error' : '' }}">
                            <label for="desa" class="col-md-4 control-label">Desa</label>

                            <div class="col-md-6">
                                <input type="text" name="desa" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('kordinat') ? ' has-error' : '' }}">
                            <label for="kordinat" class="col-md-4 control-label">Koordinat Lokasi</label>
                            <div class="col-md-3">
                                <input type="text" name="latitude" class="form-control" />
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="longitude" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('calon_penerima') ? ' has-error' : '' }}">
                            <label for="kordinat" class="col-md-4 control-label">Calon Penerima </label>
                            <div class="col-md-6">
                                <input type="text" name="calon_penerima" class="form-control"/>
                            </div>
                        </div>

                        

                        <div class="form-group{{ $errors->has('jumlah_usulan') ? ' has-error' : '' }}">
                            <label for="kordinat" class="col-md-4 control-label">Jumlah Usulan (Rp.)</label>
                            <div class="col-md-6">
                                <input type="text" name="jumlah_usulan" class="form-control"/>

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('jumlah_satuan_usulan') ? ' has-error' : '' }}">
                            <label for="kordinat" class="col-md-4 control-label">Jumlah Satuan Usulan</label>
                            <div class="col-md-6">
                                <input type="text" name="jumlah_satuan_usulan" class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dokumentasi') ? ' has-error' : '' }}">
                            <label for="kordinat" class="col-md-4 control-label">Dokumentasi Lokasi Eksisting</label>
                            <div class="col-md-6">
                                <input type="file" name="dokumentasi">
                                
                            </div>
                        </div>

                       


                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
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
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Pembangunan Jalan Sirip</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" enctype='multipart/form-data'>
                        {{ csrf_field() }}

                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="#jalan_sirip" data-toggle="tab">Pembangunan Jalan Sirip</a></li>
                              <li class="disabled disabledTab"><a href="#sarana_air_bersih" data-toggle="tab" >Pembangunan Sarana Air Bersih</a></li>
                              <li class="disabled disabledTab"><a href="#plts" data-toggle="tab" >Pembangunan Pembangkit Listrik Tenaga Surya (PLTS)</a></li>
                             
                            </ul>
                            <div class="tab-content">
                              <div class="tab-pane active" id="jalan_sirip">
                                
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
                                      <td><input type="radio" name="admin_1" value="1"></td>
                                      <td><input type="radio" name="admin_1" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>
                                    <tr>
                                      <td>2.</td>
                                      <td>Surat Keputusan Bupati tentang Usulan Penetapan Lokasi</td>
                                      <td><input type="radio" name="admin_2" value="1"></td>
                                      <td><input type="radio" name="admin_2" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>
                                    <tr>
                                      <td></td>
                                      <td>- Kecamatan</td>
                                      <td><input type="radio" name="admin_2a" value="1"></td>
                                      <td><input type="radio" name="admin_2a" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>
                                    <tr>
                                      <td></td>
                                      <td>- Desa</td>
                                      <td><input type="radio" name="admin_2b" value="1"></td>
                                      <td><input type="radio" name="admin_2b" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>
                                    <tr>
                                      <td></td>
                                      <td>- Titik Koordinat</td>
                                      <td><input type="radio" name="admin_2c" value="1"></td>
                                      <td><input type="radio" name="admin_2c" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>
                                    <tr>
                                      <td>3</td>
                                      <td>Surat Keterangan Pembebasan Lahan</td>
                                      <td><input type="radio" name="admin_3" value="1"></td>
                                      <td><input type="radio" name="admin_3" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>
                                    <tr>
                                      <td>4</td>
                                      <td>Surat Keputusan Bupati tentang Penunjukan Organisasi Perangkat Daerah (OPD) Teknis</td>
                                      <td><input type="radio" name="admin_4" value="1"></td>
                                      <td><input type="radio" name="admin_4" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>
                                    <tr>
                                      <td>5</td>
                                      <td>Surat Keputusan Bupati tentang Tim Usulan Tim Pengendali Teknis Bantuan Pemerintah</td>
                                      <td><input type="radio" name="admin_5" value="1"></td>
                                      <td><input type="radio" name="admin_5" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>
                                    <tr>
                                      <td>6</td>
                                      <td>Surat Pernyataan Bupati bahwa lokasi kegiatan adalah jalan non-status belum pernah dilakukan penanganan</td>
                                      <td><input type="radio" name="admin_6" value="1"></td>
                                      <td><input type="radio" name="admin_6" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>
                                    <tr>
                                      <td>7</td>
                                      <td>Surat Pernyataan Bupati bahwa kegiatan sesuai dengan arah kebijakan pemanfaatan ruang</td>
                                      <td><input type="radio" name="admin_7" value="1"></td>
                                      <td><input type="radio" name="admin_7" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>
                                    <tr>
                                      <td>8</td>
                                      <td>Surat Pernyataan Bupati tentang kesediaan menerima hibah aset bantuan pemerintah</td>
                                      <td><input type="radio" name="admin_8" value="1"></td>
                                      <td><input type="radio" name="admin_8" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>
                                    <tr>
                                      <td>9</td>
                                      <td>Surat Pernyataan Bupati mengenai kesanggupan mengelola, memelihara dan mengembangkan aset bantuan pemerintah</td>
                                      <td><input type="radio" name="admin_9" value="1"></td>
                                      <td><input type="radio" name="admin_9" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>


                                    <tr>
                                      <td>1</td>
                                      <td>Isi Proposal Teknis</td>
                                      <td><input type="radio" name="teknis_1" value="1"></td>
                                      <td><input type="radio" name="teknis_1" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Latar Belakang</td>
                                      <td><input type="radio" name="teknis_1a" value="1"></td>
                                      <td><input type="radio" name="teknis_1a" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Maksud dan Tujuan</td>
                                      <td><input type="radio" name="teknis_1b" value="1"></td>
                                      <td><input type="radio" name="teknis_1b" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Sasaran</td>
                                      <td><input type="radio" name="teknis_1c" value="1"></td>
                                      <td><input type="radio" name="teknis_1c" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Keluaran</td>
                                      <td><input type="radio" name="teknis_1d" value="1"></td>
                                      <td><input type="radio" name="teknis_1d" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Ruang Lingkup</td>
                                      <td><input type="radio" name="teknis_1e" value="1"></td>
                                      <td><input type="radio" name="teknis_1e" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Manfaat (outcome)</td>
                                      <td><input type="radio" name="teknis_1f" value="1"></td>
                                      <td><input type="radio" name="teknis_1f" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Waktu Pelaksanaan</td>
                                      <td><input type="radio" name="teknis_1g" value="1"></td>
                                      <td><input type="radio" name="teknis_1g" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Jadwal Pelaksanaan</td>
                                      <td><input type="radio" name="teknis_1h" value="1"></td>
                                      <td><input type="radio" name="teknis_1h" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Lokasi Kegiatan</td>
                                      <td><input type="radio" name="teknis_1i" value="1"></td>
                                      <td><input type="radio" name="teknis_1i" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Rencana Anggaran Biaya</td>
                                      <td><input type="radio" name="teknis_1j" value="1"></td>
                                      <td><input type="radio" name="teknis_1j" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Rencana Pengembangan (yang disetujui dan disahkan oleh pejabat yang berwenang)</td>
                                      <td><input type="radio" name="teknis_1k" value="1"></td>
                                      <td><input type="radio" name="teknis_1k" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td>2</td>
                                      <td>Kerangka Acuan Kerja (KAK)</td>
                                      <td><input type="radio" name="teknis_2" value="1"></td>
                                      <td><input type="radio" name="teknis_2" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Latar Belakang</td>
                                      <td><input type="radio" name="teknis_2a" value="1"></td>
                                      <td><input type="radio" name="teknis_2a" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Maksud dan Tujuan</td>
                                      <td><input type="radio" name="teknis_2b" value="1"></td>
                                      <td><input type="radio" name="teknis_2b" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Sasaran</td>
                                      <td><input type="radio" name="teknis_2c" value="1"></td>
                                      <td><input type="radio" name="teknis_2c" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Keluaran</td>
                                      <td><input type="radio" name="teknis_2d" value="1"></td>
                                      <td><input type="radio" name="teknis_2d" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Ruang Lingkup</td>
                                      <td><input type="radio" name="teknis_2e" value="1"></td>
                                      <td><input type="radio" name="teknis_2e" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Manfaat (outcome)</td>
                                      <td><input type="radio" name="teknis_2f" value="1"></td>
                                      <td><input type="radio" name="teknis_2f" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Waktu Pelaksanaan</td>
                                      <td><input type="radio" name="teknis_2g" value="1"></td>
                                      <td><input type="radio" name="teknis_2g" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Lokasi Kegiatan</td>
                                      <td><input type="radio" name="teknis_2h" value="1"></td>
                                      <td><input type="radio" name="teknis_2h" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Biaya Pelaksanaan</td>
                                      <td><input type="radio" name="teknis_2i" value="1"></td>
                                      <td><input type="radio" name="teknis_2i" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Sumber Dana</td>
                                      <td><input type="radio" name="teknis_2j" value="1"></td>
                                      <td><input type="radio" name="teknis_2j" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>


                                    <tr>
                                      <td>3</td>
                                      <td>Peta Orientasi Lokasi Bantuan Pemerintah (lokasi yang akan dilakukan pembangunan)</td>
                                      <td><input type="radio" name="teknis_3" value="1"></td>
                                      <td><input type="radio" name="teknis_3" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Kecamatan</td>
                                      <td><input type="radio" name="teknis_3a" value="1"></td>
                                      <td><input type="radio" name="teknis_3a" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Desa</td>
                                      <td><input type="radio" name="teknis_3b" value="1"></td>
                                      <td><input type="radio" name="teknis_3b" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td></td>
                                      <td>- Titik Koordinat</td>
                                      <td><input type="radio" name="teknis_3c" value="1"></td>
                                      <td><input type="radio" name="teknis_3c" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td>4</td>
                                      <td>Spesifikasi Teknis</td>
                                      <td><input type="radio" name="teknis_4" value="1"></td>
                                      <td><input type="radio" name="teknis_4" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td>5</td>
                                      <td>Gambar Teknis atau Detail Engineering Design (DED) (telah disetujui dan disahkan oleh pejabat yang berwenang)</td>
                                      <td><input type="radio" name="teknis_5" value="1"></td>
                                      <td><input type="radio" name="teknis_5" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td>6</td>
                                      <td>Analisa Harga Satuan</td>
                                      <td><input type="radio" name="teknis_6" value="1"></td>
                                      <td><input type="radio" name="teknis_6" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td>7</td>
                                      <td>Standar Biaya Daerah (SBD) dan/atau Standar Biaya Masukan (SBM)</td>
                                      <td><input type="radio" name="teknis_6" value="1"></td>
                                      <td><input type="radio" name="teknis_6" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    <tr>
                                      <td>7</td>
                                      <td>Rencana Anggaran Biaya (RAB)</td>
                                      <td><input type="radio" name="teknis_6" value="1"></td>
                                      <td><input type="radio" name="teknis_6" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                </tbody>
                                </table>

                               
                              </div>
                              <!-- /.tab-pane -->
                              <div class="tab-pane" id="sarana_air_bersih">
                                <b>Bentuk Bantuan  :   Belanja Barang Jalan, Irigasi dan Jaringan Untuk Diserahkan Pada Masyarakat/Pemda</b><br>
                                <b>Sub Bentuk Bantuan  :   Pembangunan Sarana Air Bersih</b>

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
                                      <td><input type="text" name="keterangan"></td>
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
                                      <td><input type="radio" name="sab_admin_9" value="1"></td>
                                      <td><input type="radio" name="sab_admin_9" value="0"></td>
                                      <td><input type="text" name="keterangan"></td>
                                    </tr>

                                    
                                     - Latar Belakang
                                     - Maksud dan Tujuan
                                     - Sasaran
                                     - Keluaran
                                     - Ruang Lingkup
                                     - Manfaat (outcome)
                                     - Waktu Penyaluran
                                     - Jadwal Penyaluran
                                     - Lokasi Kegiatan
                                     - Rencana Anggaran Biaya
                                     - Rencana Pengembangan (yang disetujui dan disahkan oleh pejabat yang berwenang)


                                    
                                    


                                </tbody>
                                </table>
                              </div>
                              <!-- /.tab-pane -->
                              <div class="tab-pane" id="plts">
                                <b>Bentuk Bantuan  :   Belanja Barang Jalan, Irigasi dan Jaringan Untuk Diserahkan Pada Masyarakat/Pemda</b><br>
                                <b>Sub Bentuk Bantuan  :   Pembangunan Pembangkit Listrik Tenaga Surya (PLTS)</b>
                              </div>
                              <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>

                       


                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
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
