@extends('layouts.adminlte')


@section('content')
	<form enctype='multipart/form-data' method="POST">
	{{ csrf_field() }}
	<input type="hidden" id="jenis_usulan" name="jenis_usulan" value="{{ $usulan->jenis_usulan }}">
	<input type="hidden" name="usulan_id" value="{{ $usulan->id }}">
	<input type="hidden" name="user_id" value="{{ $usulan->user_id }}">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">PERSYARATAN BANTUAN PEMERINTAH</div>
                <div class="panel-body">
                    
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('tahun') ? ' has-error' : '' }}">
                            <label for="tahun" class="control-label">Tahun Usulan</label>
                            <select name="tahun" id="tahun" class="form-control" disabled="">
                                    <option value="0">----</option>
                                    <option value="2018" @if($usulan->tahun_usulan == '2018') selected @endif>2018</option>
                                    <option value="2018" @if($usulan->tahun_usulan == '2019') selected @endif>2019</option>
                                    <option value="2018" @if($usulan->tahun_usulan == '2020') selected @endif>2020</option>
                            </select>
                            
                        </div>
                    <div id="usulan-group-">
                        <div class="form-group{{ $errors->has('jenis_usulan') ? ' has-error' : '' }}">
                            <label for="jenis_usulan" class="control-label">Jenis Usulan</label>
                            <select name="jenis_usulan" id="jenis_usulan" class="form-control" disabled>
                                <option value="0">-----</option>
                                <option value="1" @if($usulan->jenis_usulan == '1') selected @endif>Jalan</option>
                                <option value="2" @if($usulan->jenis_usulan == '2') selected @endif>SAB</option>
                                <option value="3" @if($usulan->jenis_usulan == '3') selected @endif>PLTS</option>
                                <option value="4" @if($usulan->jenis_usulan == '4') selected @endif>Lainnya</option>
                            </select>
                        </div>
                        

                        <div class="form-group{{ $errors->has('nama_proyek') ? ' has-error' : '' }}">
                            <label for="nama_proyek" class="control-label">Nama Proyek</label>
                            <input type="text" name="nama_proyek" readonly="" class="form-control" value="{{ $usulan->nama_proyek }}" />
                            
                        </div>

                        <div class="form-group{{ $errors->has('surat_pengantar') ? ' has-error' : '' }}">
                            <label for="surat_pengantar" class="control-label">Surat Pengantar/ Surat Referensi</label>
                            <input type="text" name="surat_pengantar" readonly="" class="form-control" value="{{ $usulan->surat_kegiatan }}"/>
                            
                        </div>

                        <div class="form-group{{ $errors->has('skpd_pengusul') ? ' has-error' : '' }}">
                            <label for="kordinat" class="control-label">OPD Pengusul</label>
                            <input type="text" name="skpd_pengusul" readonly="" class="form-control" value="{{ $usulan->opd_pengusul }}"/>
                            
                        </div>

                        <div class="form-group{{ $errors->has('kordinat') ? ' has-error' : '' }}">
                            <label for="kordinat" class="control-label">Koordinat Lokasi</label>
                            <div class="input-group">
                                <input type="text" name="latitude" class="form-control" placeholder="Latitude" value="{{ $usulan->lat }}" />
                                <input type="text" name="longitude" class="form-control" placeholder="Longitude" value="{{ $usulan->lng }}" />
                                <div class="input-group-btn">
                                    <button type="button" id="checkmap" class="btn btn-primary">
                                        Check Map
                                    </button>
                                </div>

                            </div>

                                
                        </div>
                        <div id="map"></div>
                        

                        <div class="form-group{{ $errors->has('penerima_manfaat') ? ' has-error' : '' }}">
                            <label for="penerima_manfaat" class="control-label">Penerima Manfaat </label>
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                  <th>KK</th>
                                  <th>Jiwa</th>
                                  <th>Km</th>
                                  <th>Ha</th>
                                </tr>
                                <tr>
                                  <th><input type="text" class="form-control numberonly" name="penerima_manfaat_kk" placeholder="KK" value="{{ $usulan->penerima_manfaat_kk }}"></th>
                                  <th><input type="text" class="form-control numberonly" name="penerima_manfaat_jiwa" placeholder="Jiwa" value="{{ $usulan->penerima_manfaat_jiwa }}"></th>
                                  <th><input type="text" class="form-control numberonly" name="penerima_manfaat_km" placeholder="Km" value="{{ $usulan->penerima_manfaat_km }}"></th>
                                  <th><input type="text" class="form-control numberonly" name="penerima_manfaat_ha" placeholder="Ha" value="{{ $usulan->penerima_manfaat_ha }}"></th>
                                </tr>
                                </tbody>
                            </table>
                            
                        </div>
                            
                        
                        <div class="form-group{{ $errors->has('jumlah_usulan') ? ' has-error' : '' }}">
                            <label for="jumlah_usulan" class="control-label">Jumlah Usulan (Juta)</label>
                            <input type="text" name="jumlah_usulan" class="form-control numberonly" value="{{ $usulan->jumlah_usulan }}" placeholder="jumlah_usulan" />
                        </div>

                        <div class="form-group{{ $errors->has('dokumentasi') ? ' has-error' : '' }}">
                            <label for="dokumentasi" class="control-label">Dokumentasi Lokasi Eksisting</label>
                            <input type="file" id="inputgambar" name="dokumentasi" class="validate"/ >
                            <p class="help-block"><i class="fa fa-file-pdf-o" class="text-red"></i><span>File Maksimal 200 Mb.</span></p>

                        </div>
                    </div>



                    
                </div>
            </div>
        </div>
	</div>
	<div class="row">
        <div class="col-xs-12">
	        <div class="box">
	        	@if(count($usulan->pjalan) > 0)
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
	                                    @foreach($usulan->pjalan as $k => $v)
	                                    	@if($v->tipeusulan == 'admin')
	                                        <tr>
	                                          <td>{{ $v->no }}</th>
	                                          <td>{{$v->namausulan}}</th>
	                                          <td><input type="radio" name="jalanadmin[{{$k}}]" @if($v->isi) checked @endif value="1"></td>
	                                          <td><input type="radio" name="jalanadmin[{{$k}}]" @if(!$v->isi) checked @endif value="0"></td>
	                                          <td>
												<div class="input-group margin">
									                <input type="text" class="form-control jalanadmin_ft" readonly="readonly" name="jalanadmin_file_text[{{$k}}]" value="{{ $v->file }}">
									                <span class="input-group-btn">
									                	<input type="file" name="jalanadmin_file[{{$k}}]" class="hidden jalanadmin_file fileupload">
									                    <button type="button" class="btn btn-info btn-flat formUpload">File!</button>
									                </span>
									            </div>
									            <input type="hidden" name="pjalanadmin_id[{{$k}}]" value="{{ $v->JalanID }}">
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
	                                          <td><input type="radio" name="jalanteknis[{{$k}}]" @if($v->isi) checked @endif value="1"></td>
	                                          <td><input type="radio" name="jalanteknis[{{$k}}]" @if(!$v->isi) checked @endif value="0"></td>
	                                          <td>
	                                          	<div class="input-group margin">
									                <input type="text" class="form-control jalanteknis_ft" readonly="readonly" name="jalanteknis_file_text[{{$k}}]" value="{{ $v->file }}">
									                <span class="input-group-btn">
									                	<input type="file" name="jalanteknis_file[{{$k}}]" class="hidden jalanteknis_file fileupload">
									                    <button type="button" class="btn btn-info btn-flat formUpload">File!</button>
									                </span>
									            </div>
									            <input type="hidden" name="pjalanteknis_id[{{$k}}]" value="{{ $v->JalanID }}">
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
	            @endif
	            @if(count($usulan->psab) > 0)
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
	                                          <td><input type="radio" name="sabadmin[{{$k}}]" @if($v->isi) checked @endif value="1"></td>
	                                          <td><input type="radio" name="sabadmin[{{$k}}]" @if(!$v->isi) checked @endif value="0"></td>
	                                          <td>
												<div class="input-group margin">
									                <input type="text" class="form-control sabadmin_ft" readonly="readonly" name="sabadmin_file_text[{{$k}}]" value="{{ $v->file }}">
									                <span class="input-group-btn">
									                	<input type="file" name="sabadmin_file[{{$k}}]" class="hidden sabadmin_file fileupload">
									                    <button type="button" class="btn btn-info btn-flat formUpload">File!</button>
									                </span>
									            </div>
									            <input type="hidden" name="psabadmin_id[{{$k}}]" value="{{ $v->SabID }}">
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
	                                          <td><input type="radio" name="sabteknis[{{$k}}]" @if($v->isi) checked @endif value="1"></td>
	                                          <td><input type="radio" name="sabteknis[{{$k}}]" @if(!$v->isi) checked @endif value="0"></td>
	                                          <td>
	                                          	<div class="input-group margin">
									                <input type="text" class="form-control sabteknis_ft" readonly="readonly" name="sabteknis_file_text[{{$k}}]" value="{{ $v->file }}">
									                <span class="input-group-btn">
									                	<input type="file" name="sabteknis_file[{{$k}}]" class="hidden sabteknis_file fileupload">
									                    <button type="button" class="btn btn-info btn-flat formUpload">File!</button>
									                </span>
									            </div>
	                                          </td>
	                                          <td>
	                                            
	                                            <input type="hidden" name="psabteknis_id[{{$k}}]" value="{{ $v->SabID }}">
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
	            @endif
	            @if(count($usulan->pplts) > 0)
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
	                                          <td><input type="radio" name="pltsadmin[{{$k}}]" @if($v->isi) checked @endif value="1"></td>
	                                          <td><input type="radio" name="pltsadmin[{{$k}}]" @if(!$v->isi) checked @endif value="0"></td>
	                                          <td>
	                                          	<div class="input-group margin">
									                <input type="text" class="form-control pltsadmin_ft" readonly="readonly" name="pltsadmin_file_text[{{$k}}]" value="{{ $v->file }}">
									                <span class="input-group-btn">
									                	<input type="file" name="pltsadmin_file[{{$k}}]" class="hidden pltsadmin_file fileupload">
									                    <button type="button" class="btn btn-info btn-flat formUpload">File!</button>
									                </span>
									            </div>
									            <input type="hidden" name="ppltsadmin_id[{{$k}}]" value="{{ $v->PltsID }}">
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
	                                          <td><input type="radio" name="pltsteknis[{{$k}}]" @if($v->isi) checked @endif value="1"></td>
	                                          <td><input type="radio" name="pltsteknis[{{$k}}]" @if(!$v->isi) checked @endif value="0"></td>
	                                          <td>
	                                          	<div class="input-group margin">
									                <input type="text" class="form-control pltsteknis_ft" readonly="readonly" name="pltsteknis_file_text[{{$k}}]" value="{{ $v->file }}">
									                <span class="input-group-btn">
									                	<input type="file" name="pltsteknis_file[{{$k}}]" class="hidden pltsteknis_file fileupload">
									                    <button type="button" class="btn btn-info btn-flat formUpload">File!</button>
									                </span>
									            </div>
									            <input type="hidden" name="ppltsteknis_id[{{$k}}]" value="{{ $v->PltsID }}">
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
	            @endif
	        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">

          <button type="submit" class="btn btn-primary pull-right">
            <i class="fa fa-submit"></i> Kirim
          </button>
        </div>
    </div>
    </form>
@endsection