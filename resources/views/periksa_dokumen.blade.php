@extends('layouts.adminlte')

@section('content')
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
                              <li><a href="#sarana_air_bersih" data-toggle="tab" >Pembangunan Sarana Air Bersih</a></li>
                              <li><a href="#plts" data-toggle="tab" >Pembangunan Pembangkit Listrik Tenaga Surya (PLTS)</a></li>
                             
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
                                    @foreach($jalan_array as $k => $v)

                                    <tr>
                                      <td>{{$k}}</td>
                                      <td>{{$v['label']}}</td>
                                      <td><input type="radio" name="{{$v['key']}}" value="1"></td>
                                      <td><input type="radio" name="{{$v['key']}}" value="0"></td>
                                      <td><input type="text" name="{{$v['key']}}_keterangan"></td>
                                    </tr>
                                    @endforeach

                                </tbody>
                                </table>

                         
                               
                              </div>
                              <!-- /.tab-pane -->
                              <div class="tab-pane" id="sarana_air_bersih">
                                <b>Bentuk Bantuan  :   Belanja Barang Jalan, Irigasi dan Jaringan Untuk Diserahkan Pada Masyarakat/Pemda</b><br>
                                <b>Sub Bentuk Bantuan  :   Pembangunan Sarana Air Bersih</b>

                          
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
                            <div class="col-md-2">
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