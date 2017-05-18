@extends('layouts.adminlte')
@section('content')
<div class="row">
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Provinsi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              	<table class="table table-bordered">
                <tbody>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Provinsi</th>
                  
                </tr>
                @foreach($provinsi as $k => $v)
                <tr>
                  <td>{{$v->kode_provinsi}}</td>
                  <td>{{$v->provinsi}}</td>
                  
                </tr>
                @endforeach
                
              	</tbody>
              	</table>
            </div>
            
          </div>
        </div>
</div>
@endsection