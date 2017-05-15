@extends('layouts.adminlte')


@section('content')
	<form enctype='multipart/form-data' method="POST">
	{{ csrf_field() }}
	<input type="hidden" id="jenis_usulan" name="jenis_usulan" value="{{ $usulan->jenis_usulan }}">
	<input type="hidden" name="usulan_id" value="{{ $usulan->id }}">
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
												<input type="text" name="jalanadmin_file_text[{{$k}}]" class="jalanadmin_ft">
	                                          	<input type="file" name="jalanadmin_file[{{$k}}]">
	                                          </td>
	                                          <td>
	                                            
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
	                                          	<input type="hidden" name="jalanteknis_file_text[{{$k}}]">
	                                          	<input type="file" name="jalanteknis_file[{{$k}}]">
	                                          </td>
	                                          <td>
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
									                <input type="text" class="form-control sabadmin_ft" readonly="readonly" name="sabadmin_file_text[{{$k}}]">
									                <span class="input-group-btn">
									                	<input type="file" name="sabadmin_file[{{$k}}]" class="hidden sabadmin_file">
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
									                <input type="text" class="form-control sabteknis_ft" readonly="readonly" name="sabteknis_file_text[{{$k}}]">
									                <span class="input-group-btn">
									                	<input type="file" name="sabteknis_file[{{$k}}]" class="hidden sabteknis_file">
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
									                <input type="text" class="form-control pltsadmin_ft" readonly="readonly" name="pltsadmin_file_text[{{$k}}]">
									                <span class="input-group-btn">
									                	<input type="file" name="pltsadmin_file[{{$k}}]" class="hidden pltsadmin_file">
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
									                <input type="text" class="form-control pltsteknis_ft" readonly="readonly" name="pltsteknis_file_text[{{$k}}]">
									                <span class="input-group-btn">
									                	<input type="file" name="pltsteknis_file[{{$k}}]" class="hidden pltsteknis_file">
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
	        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">

          <button type="submit" class="btn btn-primary pull-right">
            <i class="fa fa-submit"></i> Submit
          </button>
        </div>
    </div>
    </form>
@endsection