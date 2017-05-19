@extends('layouts.adminlte')
@section('content')
	<div class="row">
    <div class="col-md-12">
        <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-warning"></i>

              <h3 class="box-title">Pengecekan</h3>
            </div>
            
            <div class="box-body">
                <!-- title row -->
                <div class="row">
                  <div class="col-xs-12">
                    <h2 class="page-header">
                      <i class="fa fa-globe"></i> PLANNAR.
                      <small class="pull-right">Tanggal: {{$usulan->created_at->format('m/d/Y H:i:s')}}</small>
                    </h2>
                  </div>
                  <!-- /.col -->
                </div>
                <input type="hidden" name="user_id" value="{{$usulan->user_id}}">
                <!-- info row -->
                <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                    
                    <address>
                      <strong></strong><br>
                      {{$usulan->provinsi}}<br>
                      {{$usulan->kabupaten}}<br>
                      {{$usulan->kecamatan}}<br>
                      {{$usulan->desa}}
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    
                    <address>
                      <strong>{{$usulan->skpd_pengusul}}</strong><br>
                      {{$usulan->penerima_manfaat}} {{$usulan->skpd_pengusul_satuan}}<br>
                      Rp. {{number_format($usulan->jumlah_usulan,2,",",".")}}<br>
                      
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    <b>Usulan #{{$usulan->tahun_usulan}}{{ rand() }}{{$usulan->user_id}}</b><br>
                    <br>
                    <b>Pengusulan:</b> {{$jenis}}
                    <input type="hidden" name="jenis_usulan" value="{{$usulan->jenis_usulan}}"><br>
                    <b>Tahun:</b> {{$usulan->tahun_usulan}}<br>
                    <b>User:</b> {{$usulan->user_id}}
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <input type="hidden" name="usulan_id" value="{{$usulan->id}}">
                <!-- Table row -->
                <div class="row">
                  <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Usulan</th>
                        <th>Ada/Tidak</th>
                        <th>Verifikasi Data</th>
                        <th>Dokumen</th>
                        <th>Keterangan</th>
                        
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                      if(isset($usulan->pjalan)){
                      ?>
                      @foreach($usulan->pjalan as $k => $v)
                        <?php
                          $disabled = ($v->isi) ? '' : 'disabled';
                          $checked = ($v->verifikasi) ? 'checked' : '';
                          $fileexist = (file_exists(public_path('files').'/'.$v->file)) ? '<a href="/files/'.$v->file.'" class="fa fa-file-text text-green"></a>' : '<a href="#" class="fa fa-file-text text-gray"></a>' ;
                          $adatidak = ($v->isi) ? "<i class='fa fa-check text-blue'></i>":"<i class='fa fa-close text-red'></i>";
                        ?>
                      <tr>
                        <td><input type="hidden" name="pjalan_id[{{$k}}]" value="{{$v->pjalan_id}}">{{$v->no}}</td>
                        <td>{{$v->namausulan}}</td>
                        <td>{!!$adatidak!!}</td>
                        <td>
                          <input type="checkbox" name="verifikasi[{{$k}}]" value="1" {{$disabled}} {{$checked}}>
                        </td>
                        <td>{!!$fileexist!!}</td>
                        <td><input type="text" name="keterangan[{{$k}}]" value="{{$v->keterangan}}"></td>
                      </tr>
                      @endforeach
                      <?php
                      }
                      ?>

                      <?php
                      if(isset($usulan->psab)){
                      ?>
                      @foreach($usulan->psab as $k => $v)
                        <?php
                          $disabled = ($v->isi) ? '' : 'disabled';
                          $verifikasi = ($v->verifikasi == 1) ? 'checked':'';

                          $fileexist = (file_exists(public_path('files').'/'.$v->file)) ? '<a href="/files/{{$v->file}}" class="fa fa-file-text text-green"></a>' : '<a href="#" class="fa fa-file-text text-gray"></a>' ;
                          $adatidak = ($v->isi) ? "<i class='fa fa-check text-blue'></i>":"<i class='fa fa-close text-red'></i>";

                        ?>
                      <tr>
                        <td><input type="hidden" name="psab_id[{{$k}}]" value="{{$v->psab_id}}">{{$v->no}}</td>
                        <td>{{$v->namausulan}}</td>
                        <td>{!!$adatidak!!}</td>
                        <td>{{$v->verifikasi}}</td>
                        <td>
                          <input type="checkbox" name="verifikasi[{{$k}}]" value="1" {{$disabled}} {{$verifikasi}}>
                        </td>
                        <td>{!!$fileexist!!}</td>
                        
                        <td><input type="text" name="keterangan[{{$k}}]" value="{{$v->keterangan}}"></td>
                      </tr>
                      @endforeach
                      <?php
                      }
                      ?>

                      <?php
                      if(isset($usulan->pplts)){
                      ?>
                      @foreach($usulan->pplts as $k => $v)
                        <?php
                          $disabled = ($v->isi) ? '' : 'disabled';
                          $verifikasi = ($v->verifikasi == 1) ? 'checked':'';
                          $fileexist = (file_exists(public_path('files').'/'.$v->file)) ? '<a href="/files/{{$v->file}}" class="fa fa-file-text text-green"></a>' : '<a href="#" class="fa fa-file-text text-gray"></a>' ;
                          $adatidak = ($v->isi) ? "<i class='fa fa-check text-blue'></i>":"<i class='fa fa-close text-red'></i>";
                        ?>
                      <tr>
                        <td><input type="hidden" name="pplts_id[{{$k}}]" value="{{$v->pplts_id}}">{{$v->no}}</td>
                        <td>{{$v->namausulan}}</td>
                        <td>{!!$adatidak!!}</td>
                        <td>
                          <input type="checkbox" name="verifikasi[{{$k}}]" value="1" {{$disabled}} {{$verifikasi}}>
                        </td>
                        <td>{!!$fileexist!!}</td>
                        <td><input type="text" name="keterangan[{{$k}}]" value="{{$v->keterangan}}"></td>
                      </tr>
                      @endforeach
                      <?php
                      }
                      ?>
                      
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

              
                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  
                  <div class="col-xs-5 pull-right">
                    <div class="input-group margin">
                      <select name="status" class="form-control">
                        <option value="0">Belum Disetujui</option>
                        <option value="1">Diproses</option>
                        <option value="2">Disetujui</option>
                      </select>
                      <span class="input-group-btn">
                          <button type="submit" class="btn btn-success pull-right">Submit</button>
                      </span>
                    </div>
                  </div>
                </div>        
            </div>
            
        </div>
        
    </div>
  	</div>
@endsection