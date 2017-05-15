@extends('layouts.adminlte')


@section('content')
    <form method="POST" enctype='multipart/form-data'>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">PERSYARATAN BANTUAN PEMERINTAH</div>
                <div class="panel-body">
                    
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('tahun') ? ' has-error' : '' }}">
                            <label for="tahun" class="control-label">Tahun Usulan</label>
                            <select name="tahun" id="tahun" class="form-control">
                                    <option value="0">----</option>
                                    <option value="2018">2018</option>
                                    <option value="2018">2019</option>
                                    <option value="2018">2020</option>
                            </select>
                            
                        </div>
                        <div id="usulan-group">
                        <div class="form-group{{ $errors->has('jenis_usulan') ? ' has-error' : '' }}">
                            <label for="desa" class="control-label">Jenis Usulan</label>
                            <select name="jenis_usulan" id="jenis_usulan" class="form-control">
                                <option value="0">-----</option>
                                <option value="1">Jalan</option>
                                <option value="2">SAB</option>
                                <option value="3">PLTS</option>
                                <option value="4">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group{{ $errors->has('provinsi') ? ' has-error' : '' }}">
                            <label for="provinsi" class="control-label">Provinsi</label>
                            <select name="provinsi" id="provinsi" class="form-control">
                                    <option value="--">----</option>
                                    @foreach($provinsi as $k => $v)
                                        <option value="{{ $v->kode_provinsi }}">{{$v->provinsi}}</option>
                                    @endforeach
                            </select>
                            
                        </div>

                        <div class="form-group{{ $errors->has('kabupaten') ? ' has-error' : '' }}">
                            <label for="kabupaten" class="control-label">Kabupaten/Kota</label>
                            <select name="kabupaten" id="kabkota" class="form-control"></select>
                            
                        </div>

                        <div class="form-group{{ $errors->has('kecamatan') ? ' has-error' : '' }}">
                            <label for="kecamatan" class="control-label">Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" class="form-control"></select>
                        </div>

                        <div class="form-group{{ $errors->has('desa') ? ' has-error' : '' }}">
                            <label for="desa" class="control-label">Desa</label>
                            <select name="desa" id="desa" class="form-control">
                              <option value="---">-------</option>
                            </select>
                            
                        </div>

                        <div class="form-group{{ $errors->has('skpd_pengusul') ? ' has-error' : '' }}">
                            <label for="kordinat" class="control-label">SKPD Pengusul</label>
                            <input type="text" name="skpd_pengusul" class="form-control"/>
                            
                        </div>

                        <div class="form-group{{ $errors->has('kordinat') ? ' has-error' : '' }}">
                            <label for="kordinat" class="control-label">Koordinat Lokasi</label>
                            <div class="input-group">
                                <input type="text" name="latitude" class="form-control" placeholder="Latitude" />
                                <input type="text" name="longitude" class="form-control" placeholder="Longitude" />
                                <div class="input-group-btn">
                                    <button type="button" id="checkmap" class="btn btn-primary">
                                        Check Map
                                    </button>
                                </div>

                            </div>
                                
                            
                        </div>

                        <div class="form-group{{ $errors->has('penerima_manfaat') ? ' has-error' : '' }}">
                            <label for="kordinat" class="control-label">Penerima Manfaat </label>
                            <input type="text" id="penerima_manfaat" name="penerima_manfaat" class="form-control"/>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <select id="penerima_manfaat_satuan" name="penerima_manfaat_satuan" class="form-control">
                                        <option>KK</option>
                                        <option>Jiwa</option>
                                        <option>Km</option>
                                    </select> 
                                </span>
                                    
                            </div>
                            
                        </div>
                        
                        <div class="form-group{{ $errors->has('jumlah_usulan') ? ' has-error' : '' }}">
                            <label for="jumlah_usulan" class="control-label">Jumlah Usulan (Rp.)</label>
                            <input type="text" name="jumlah_usulan" class="form-control" placeholder="jumlah_usulan" />
                        </div>

                        <div class="form-group{{ $errors->has('dokumentasi') ? ' has-error' : '' }}">
                            <label for="dokumentasi" class="control-label">Dokumentasi Lokasi Eksisting</label>
                            <input type="file" id="inputgambar" name="dokumentasi" class="validate"/ >
                                
                            
                        </div>
                        </div>
                        <!--<div id="usulan_jenis_pilih">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="#jalan_sirip" data-toggle="tab">Pembangunan Jalan Sirip</a></li>
                              <li><a href="#sarana_air_bersih" data-toggle="tab" >Pembangunan Sarana Air Bersih</a></li>
                              <li><a href="#plts" data-toggle="tab" >Pembangunan Pembangkit Listrik Tenaga Surya (PLTS)</a></li>
                            </ul>
                            <div class="tab-content">
                              <div class="tab-pane active" id="jalan_sirip">
                                @include('usulan.usulan_jalan')
                                
                              </div>
                              <div class="tab-pane" id="sarana_air_bersih">
                                @include('usulan.usulan_sab')
                              </div>
                              <div class="tab-pane" id="plts">
                                @include('usulan.usulan_plts')
                              </div>
                            </div>
                        </div>
                        </div>-->


                        <div class="form-group">
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary">
                                    Proses
                                </button>
                            </div>
                        </div>


                    
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="usulan_jenis_pilih">
        <div class="col-xs-12">
        <div class="box">
            <div class="pjalan">
                <div class="box-header">
                  <h3 class="box-title">Jalan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#jalanadmin" data-toggle="tab">Administrasi</a></li>
                            <li><a href="#jalanteknis" data-toggle="tab" >Teknis</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="jalanadmin">
                                <table class="table">
                                    <thead>
                                        <tr>
                                          <th>#</th>
                                          <th></th>
                                          <th>Ada</th>
                                          <th>Tidak</th>
                                          <th>File</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($jalan as $k => $v)
                                        @if($v->tipeusulan == 'admin')
                                        <tr>
                                          <td>{{ $v->no }}</th>
                                          <td>{{$v->namausulan}}</th>
                                          <td><input type="radio" name="jalanadmin[{{$k}}]" value="1"></td>
                                          <td><input type="radio" name="jalanadmin[{{$k}}]" value="0"></td>
                                          <td>
                                            <div class="input-group margin">
                                                <input type="text" class="form-control jalanadmin_ft" readonly="readonly" name="jalanadmin_file_text[{{$k}}]" value="{{ $v->file }}">
                                                <span class="input-group-btn">
                                                  <input type="file" name="jalanadmin_file[{{$k}}]" class="hidden jalanadmin_file">
                                                    <button type="button" class="btn btn-info btn-flat formUpload">File!</button>
                                                </span>
                                            </div>
                                          </td>
                                          
                                          
                                          <td>
                                            
                                            <input type="hidden" name="pjalanadmin_id[{{$k}}]" value="{{ $v->id }}">
                                          </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table> 
                            </div>
                            <div class="tab-pane" id="jalanteknis">
                                <table class="table">
                                    <thead>
                                        <tr>
                                          <th>#</th>
                                          <th></th>
                                          <th>Ada</th>
                                          <th>Tidak</th>
                                          <th>File</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($jalan as $k => $v)
                                        @if($v->tipeusulan == 'teknis')
                                        <tr>
                                          <td>{{ $v->no }}</th>
                                          <td>{{$v->namausulan}}</th>
                                          <td><input type="radio" name="jalanteknis[{{$k}}]" value="1"></td>
                                          <td><input type="radio" name="jalanteknis[{{$k}}]" value="0"></td>
                                          <td>
                                            <div class="input-group margin">
                                                <input type="text" class="form-control jalanteknis_ft" readonly="readonly" name="jalanteknis_file_text[{{$k}}]" value="{{ $v->file }}">
                                                <span class="input-group-btn">
                                                  <input type="file" name="jalanteknis_file[{{$k}}]" class="hidden jalanteknis_file">
                                                    <button type="button" class="btn btn-info btn-flat formUpload">File!</button>
                                                </span>
                                            </div>

                                          </td>
                                          
                                          
                                          <td>
                                            
                                            <input type="hidden" name="pjalanteknis_id[{{$k}}]" value="{{ $v->id }}">
                                          </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="psab">
                <div class="box-header">
                  <h3 class="box-title">SAB</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#sabadmin" data-toggle="tab">Administrasi</a></li>
                            <li><a href="#sabteknis" data-toggle="tab" >Teknis</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="sabadmin">
                                <table class="table">
                                    <thead>
                                        <tr>
                                          <th>#</th>
                                          <th></th>
                                          <th>Ada</th>
                                          <th>Tidak</th>
                                          <th>File</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sab as $k => $v)
                                        @if($v->tipeusulan == 'admin')
                                        <tr>
                                          <td>{{ $v->no }}</th>
                                          <td>{{$v->namausulan}}</th>
                                          <td><input type="radio" name="sabadmin[{{$k}}]" value="1"></td>
                                          <td><input type="radio" name="sabadmin[{{$k}}]" value="0"></td>
                                          <td>
                                            <div class="input-group margin">
                                                <input type="text" class="form-control sabadmin_ft" readonly="readonly" name="sabadmin_file_text[{{$k}}]" value="{{ $v->file }}">
                                                <span class="input-group-btn">
                                                  <input type="file" name="sabadmin_file[{{$k}}]" class="hidden sabadmin_file">
                                                    <button type="button" class="btn btn-info btn-flat formUpload">File!</button>
                                                </span>
                                            </div>
                                            <input type="hidden" name="psabadmin_id[{{$k}}]" value="{{ $v->id }}">
                                          </td>
                                          
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table> 
                            </div>
                            <div class="tab-pane" id="sabteknis">
                                <table class="table">
                                    <thead>
                                        <tr>
                                          <th>#</th>
                                          <th></th>
                                          <th>Ada</th>
                                          <th>Tidak</th>
                                          <th>File</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sab as $k => $v)
                                        @if($v->tipeusulan == 'teknis')
                                        <tr>
                                          <td>{{ $v->no }}</th>
                                          <td>{{$v->namausulan}}</th>
                                          <td><input type="radio" name="sabteknis[{{$k}}]" value="1"></td>
                                          <td><input type="radio" name="sabteknis[{{$k}}]" value="0"></td>
                                          <td>
                                            
                                            <div class="input-group margin">
                                                <input type="text" class="form-control sabteknis_ft" readonly="readonly" name="sabteknis_file_text[{{$k}}]" value="{{ $v->file }}">
                                                <span class="input-group-btn">
                                                  <input type="file" name="sabteknis_file[{{$k}}]" class="hidden sabteknis_file">
                                                    <button type="button" class="btn btn-info btn-flat formUpload">File!</button>
                                                </span>
                                            </div>
                                            <input type="hidden" name="psabteknis_id[{{$k}}]" value="{{ $v->id }}">
                                          </td>
                                          
                                          
                                          <td>
                                            
                                            
                                          </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pplts">
                <div class="box-header">
                  <h3 class="box-title">PLTS</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#pltsadmin" data-toggle="tab">Administrasi</a></li>
                            <li><a href="#pltsteknis" data-toggle="tab" >Teknis</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="pltsadmin">
                                <table class="table">
                                    <thead>
                                        <tr>
                                          <th>#</th>
                                          <th></th>
                                          <th>Ada</th>
                                          <th>Tidak</th>
                                          <th>File</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($plts as $k => $v)
                                        @if($v->tipeusulan == 'admin')
                                        <tr>
                                          <td>{{ $v->no }}</th>
                                          <td>{{$v->namausulan}}</th>
                                          <td><input type="radio" name="pltsadmin[{{$k}}]" value="1"></td>
                                          <td><input type="radio" name="pltsadmin[{{$k}}]" value="0"></td>
                                          <td>
                                            
                                            <div class="input-group margin">
                                                <input type="text" class="form-control pltsadmin_ft" readonly="readonly" name="pltsadmin_file_text[{{$k}}]" value="{{ $v->file }}">
                                                <span class="input-group-btn">
                                                  <input type="file" name="pltsadmin_file[{{$k}}]" class="hidden pltsadmin_file">
                                                    <button type="button" class="btn btn-info btn-flat formUpload">File!</button>
                                                </span>
                                            </div>
                                            <input type="hidden" name="ppltsadmin_id[{{$k}}]" value="{{ $v->id }}">
                                          </td>
                                          
                                          
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table> 
                            </div>
                            <div class="tab-pane" id="pltsteknis">
                                <table class="table">
                                    <thead>
                                        <tr>
                                          <th>#</th>
                                          <th></th>
                                          <th>Ada</th>
                                          <th>Tidak</th>
                                          <th>File</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($plts as $k => $v)
                                        @if($v->tipeusulan == 'teknis')
                                        <tr>
                                          <td>{{ $v->no }}</th>
                                          <td>{{$v->namausulan}}</th>
                                          <td><input type="radio" name="pltsteknis[{{$k}}]" value="1"></td>
                                          <td><input type="radio" name="pltsteknis[{{$k}}]" value="0"></td>
                                          <td>
                                            <div class="input-group margin">
                                                <input type="text" class="form-control pltsadmin_ft" readonly="readonly" name="pltsteknis_file_text[{{$k}}]" value="{{ $v->file }}">
                                                <span class="input-group-btn">
                                                  <input type="file" name="pltsteknis_file[{{$k}}]" class="hidden pltsteknis_file">
                                                    <button type="button" class="btn btn-info btn-flat formUpload">File!</button>
                                                </span>
                                            </div>
                                            <input type="hidden" name="ppltsteknis_id[{{$k}}]" value="{{ $v->id }}">
                                          </td>
                                          
                                          
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    </form>
@endsection
