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
                  <th>Kabupaten</th>
                  
                </tr>
                @foreach($kabupaten as $k => $v)
                <tr>
                  <td>{{$v->kode_kabupaten}}</td>
                  <td>{{$v->kabupaten}}</td>
                  
                </tr>
                @endforeach
                
              	</tbody>
              	</table>
            </div>
            
          </div>
        </div>
</div>
@endsection