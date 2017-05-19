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
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Usulan</h3>
            <div class="box-tools">
                <div class="input-group">
                        
                    
                </div>
                <div class="input-group">
                    
                    <select name="search_category" id="search_category" class="search_category form-control">
                            <option value="0">Category</option>
                            <option value="1">Provinsi</option>
                            <option value="2">Kabupaten</option>
                            <option value="3">Kecamatan</option>
                            <option value="4">Desa</option>
                    </select>
                    <span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>
                    <input type="text" name="search_text" class="search_text form-control" id="search_text">
                    
                    
                </div>
            </div>
            
            
        </div>
            <!-- /.box-header -->
        <div class="box-body">
        	<table id="table_usulan" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Provinsi</th>
                        <th>Kabupaten</th>
                        <th>Kecamatan</th>
                        <th>Desa</th>
                        <th>Pengusul</th>
                        <th>Jumlah Usulan</th>
                        <th>Tahun Usulan</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Provinsi</th>
                        <th>Kabupaten</th>
                        <th>Kecamatan</th>
                        <th>Desa</th>
                        <th>Pengusul</th>
                        <th>Jumlah Usulan</th>
                        <th>Tahun Usulan</th>
                    </tr>
                </tfoot>
                
                <tbody>
                	
                </tbody>
            </table>
        </div>
    </div>

@endsection