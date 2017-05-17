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

	<table id="table_pengecekan" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>Provinsi</th>
                <th>Kabupaten</th>
                <th>Kecamatan</th>
                <th>Desa</th>
                <th>Calon Penerima</th>
                <th>Jumlah Usulan</th>
                <th>Tahun</th>
            </tr>
        </thead>
        
        <tbody>
        	
        </tbody>
    </table>

@endsection