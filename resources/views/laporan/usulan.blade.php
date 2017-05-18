@extends('layouts.adminlte')
@section('alert')
    
    @if(Session::has('Usulanstatus'))

        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-info"></i> Info!</h4>
            {!! Session::get('Usulanstatus') !!}
        </div>
        
        
    @endif
@endsection
@section('content')
<form method="post">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Laporan Usulan</h3>
        </div>
            <!-- /.box-header -->
        <div class="box-body">
        	<div class="form-group{{ $errors->has('tahun') ? ' has-error' : '' }}">
                    <label for="tahun" class="control-label">Tahun Usulan</label>
                    <select name="tahun" id="tahun" class="form-control">
                        <option value="0">----</option>
                        <option value="2018">2018</option>
                        <option value="2018">2019</option>
                        <option value="2018">2020</option>
                    </select>
            </div>
           
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
        </div>
    </div>
</form>
@endsection