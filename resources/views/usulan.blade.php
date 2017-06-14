@extends('layouts.adminlte')
<style>
    html, body, #map_canvas {
        width: 100%;
        height: 80%;
        margin: 0;
        padding: 0;
    }
    #map_canvas {
        position: relative;
    }
    </style>
</style>
@section('title','Tambah Usulan')
@section('content')
    

    <form method="POST" enctype='multipart/form-data' data-parsley-validate="">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">PERSYARATAN BANTUAN PEMERINTAH</div>
                <div class="panel-body">
                    
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('tahun') ? ' has-error' : '' }}">
                            <label for="tahun" class="control-label">Tahun Usulan</label>
                            <select name="tahun" id="tahun" class="form-control">
                                    <option value="0">----</option>
                                    <option value="2018">2018</option>
                                    <option value="2018">2019</option>
                                    <option value="2018">2020</option>
                            </select>
                            
                        </div>
                    <div id="usulan-group" style="display: none;">
                        <div class="form-group {{ $errors->has('jenis_usulan') ? ' has-error' : '' }}">
                            <label for="jenis_usulan" class="control-label">Jenis Usulan</label>
                            <select name="jenis_usulan" id="jenis_usulan" class="form-control">
                                <option value="0">-----</option>
                                <option value="1">Jalan</option>
                                <option value="2">SAB</option>
                                <option value="3">PLTS</option>
                                <option value="4">Lainnya</option>
                            </select>
                        </div>
                        @if(auth()->user()->isSuper() || auth()->user()->isManager())
                        <div class="form-group {{ $errors->has('provinsi') ? ' has-error' : '' }}">
                            <label for="provinsi" class="control-label">Provinsi</label>
                            <select name="provinsi" id="provinsi" class="form-control">
                                    <option value="--">----</option>
                                    @foreach($provinsi as $k => $v)
                                        <option value="{{ $v->kode_provinsi }}">{{$v->provinsi}}</option>
                                    @endforeach
                            </select>
                            
                        </div>

                        <div class="form-group {{ $errors->has('kabupaten') ? ' has-error' : '' }}">
                            <label for="kabupaten" class="control-label">Kabupaten/Kota</label>
                            <select name="kabupaten" id="kabkota" class="form-control"></select>
                            
                        </div>
                        @else
                        <input type="hidden" name="provinsi" id="provinsi" value="{{ auth()->user()->kode_provinsi}}" />
                        <input type="hidden" name="kabupaten" id="kabkota" value="{{ auth()->user()->kode_kabupaten}}" />
                        @endif

                        <div class="form-group {{ $errors->has('kecamatan') ? ' has-error' : '' }}">
                            <label for="kecamatan" class="control-label">Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" class="form-control"></select>
                        </div>

                        <div class="form-group {{ $errors->has('desa') ? ' has-error' : '' }}">
                            <label for="desa" class="control-label">Desa</label>
                            <select name="desa" id="desa" class="form-control">
                              <option value="---">-------</option>
                            </select>
                            
                        </div>

                        <div class="form-group {{ $errors->has('nama_proyek') ? ' has-error' : '' }}">
                            <label for="nama_proyek" class="control-label">Nama Proyek</label>
                            <input type="text" name="nama_proyek" class="form-control" required="" />
                            
                        </div>

                        <div class="form-group {{ $errors->has('surat_pengantar') ? ' has-error' : '' }}">
                            <label for="surat_pengantar" class="control-label">Surat Pengantar/ Surat Referensi</label>
                            <input type="text" name="surat_pengantar" class="form-control" required=""/>
                            
                        </div>

                        <div class="form-group {{ $errors->has('skpd_pengusul') ? ' has-error' : '' }}">
                            <label for="kordinat" class="control-label">OPD Pengusul</label>
                            <input type="text" name="skpd_pengusul" class="form-control" required=""/>
                            <span class="help-block"></span>
                            
                        </div>

                        <div class="form-group{{ $errors->has('kordinat') ? ' has-error' : '' }}">
                            <label for="kordinat" class="control-label">Koordinat Lokasi</label>
                            <div class="input-group">
                                <input type="text" name="latitude" id="latitude" class="form-control numberonly" placeholder="Latitude" required=""/>
                                <input type="text" name="longitude" id="longitude" class="form-control numberonly" placeholder="Longitude" required=""/>
                                <div class="input-group-btn">
                                    <button type="button" id="checkmap" class="btn btn-primary">
                                        Check Map
                                    </button>
                                </div>
                            </div>

                                
                        </div>
                        <div id="map_canvas"></div>
                        

                        <div class="form-group {{ $errors->has('penerima_manfaat') ? ' has-error' : '' }}">
                            <!--<label for="penerima_manfaat" class="control-label">Penerima Manfaat </label>
                            <input type="text" id="penerima_manfaat" name="penerima_manfaat" class="form-control numberonly"/>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <select id="penerima_manfaat_satuan" name="penerima_manfaat_satuan" class="form-control">
                                        <option>KK</option>
                                        <option>Jiwa</option>
                                        <option>Km</option>
                                    </select> 
                                </span>  
                            </div>-->
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
                                  <th class="spenerima_manfaat_kk"><input type="text" class="form-control numberonly" name="penerima_manfaat_kk" placeholder="KK"></th>
                                  <th class="spenerima_manfaat_jiwa"><input type="text" class="form-control numberonly" name="penerima_manfaat_jiwa" placeholder="Jiwa"></th>
                                  <th class="spenerima_manfaat_km"><input type="text" class="form-control numberonly" name="penerima_manfaat_km" placeholder="Km"></th>
                                  <th class="spenerima_manfaat_ha"><input type="text" class="form-control numberonly" name="penerima_manfaat_ha" placeholder="Ha"></th>
                                </tr>
                                </tbody>
                            </table>
                            
                        </div>
                            
                        
                        <div class="form-group {{ $errors->has('jumlah_usulan') ? ' has-error' : '' }}">
                            <label for="jumlah_usulan" class="control-label">Jumlah Usulan (Juta)</label>
                            <input type="text" name="jumlah_usulan" class="form-control numberonly" placeholder="Jumlah Usulan" required="" />
                        </div>

                        <div class="form-group {{ $errors->has('dokumentasi') ? ' has-error' : '' }}">
                            <label for="dokumentasi" class="control-label">Dokumentasi Lokasi Eksisting</label>
                            <input type="file" id="inputgambar" name="dokumentasi" class="validate"/ >
                            <p class="help-block"><i class="fa fa-file-pdf-o" class="text-red"></i><span>File Maksimal 200 Mb.</span></p>

                        </div>
                    </div>
                        <div class="form-group">
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </div>


                    
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="usulan_jenis_pilih" style="display: none;">
        <div class="col-xs-12">
        <div class="box">
            <div class="pjalan">
                <div class="box-header">
                  <h3 class="box-title">Jalan</h3>
                  <button type="submit" class="btn btn-info pull-right">Proses</button>
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
                                                  <input type="file" name="jalanadmin_file[{{$k}}]" class="hidden jalanadmin_file fileupload">
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
                                                  <input type="file" name="jalanteknis_file[{{$k}}]" class="hidden jalanteknis_file fileupload">
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
                                                  <input type="file" name="sabadmin_file[{{$k}}]" class="hidden sabadmin_file fileupload">
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
                                                  <input type="file" name="sabteknis_file[{{$k}}]" class="hidden sabteknis_file fileupload">
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
                                                  <input type="file" name="pltsadmin_file[{{$k}}]" class="hidden pltsadmin_file fileupload">
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
                                                  <input type="file" name="pltsteknis_file[{{$k}}]" class="hidden pltsteknis_file fileupload">
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

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1j4LJ2c2RhsqEiA9aWYQoJdoij9QyCYw"  type="text/javascript"></script>
    
@endsection


@section('js_tambahan')

  <script type="text/javascript">
    var map;
    var style = [];
    var layers = [];
    var line = [];
    var marker = [];
    var markers = [];
    var img = [];
    var arrMakers = new Array();
    var infowindow;
    var infoBubble;
    var geocoder;
    var myLatlng;
    google.maps.event.addDomListener(window, 'load', initialize);
    $('#checkmap').click(function(){
        if ($("#latitude").val() != "" && $("#longitude").val() != "") {
            myLatlng = new google.maps.LatLng($("#latitude").val(),$("#longitude").val());
                
                var mapOptions = {
                    zoom: 4,
                    center: myLatlng
                }

                google.maps.event.trigger(map, "resize");
                map.setCenter(myLatlng);
                marker = new google.maps.Marker({
                    position: myLatlng,
                    title: "Lokasi Usulan!",
                    map:map
                });   
        }else{
            if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function(position) {
                    console.log(position);
                    myLatlng = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
                    $("#latitude").val(position.coords.latitude);
                    $("#longitude").val(position.coords.longitude);
                    var mapOptions = {
                        zoom: 4,
                        center: myLatlng
                    }

                    google.maps.event.trigger(map, "resize");
                    map.setCenter(myLatlng);
                    marker = new google.maps.Marker({
                        position: myLatlng,
                        title: "Lokasi Usulan!",
                        map:map
                    });
              }, function() {
                
              });
            } else {
              alert("Browser doesn't support Geolocation");
            }   
        }
        
        
    });
    function initialize() {
        
        
        var C_lat   = -6.945941;    
        var C_long  = 106.764116;   
        var C_zoom  = 5;
        var mapDiv = document.getElementById('map_canvas');
            map =   new google.maps.Map(mapDiv,{
                center: new google.maps.LatLng(C_lat, C_long),
                zoom: C_zoom,
                zoomControlOptions: {
                    position: google.maps.ControlPosition.RIGHT_BOTTOM
                },
                mapTypeControlOptions: {
                        position: google.maps.ControlPosition.BOTTOM_CENTER,
                        mapTypeIds:[google.maps.MapTypeId.ROADMAP,google.maps.MapTypeId.SATELLITE],
                },
                scaleControl: true,
                streetViewControl: true,
                streetViewControlOptions: {
                    position: google.maps.ControlPosition.RIGHT_BOTTOM
                },      
                        
            });
                            
            geocoder = new google.maps.Geocoder();  
    }

    function addMarker(latlng, i=0) {
        var offset = Math.floor(Math.random() * 3) * 16; // pick one of the three icons in the sprite

        // Calculate desired pixel-size of the marker
        var size = Math.floor(4*(count-1) + 8);
        var scaleFactor = size/16;
        
        var data = i;
        var icon = {
          url: 'assets/img/marker/point/'+data.icon_pju,
          // This marker is 20 pixels wide by 32 pixels high.
          size: new google.maps.Size(20, 32),
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(0, 32)
        };
        var marker = new google.maps.Marker({
            map: map,
            position: latlng,
        
            data:data,
            icon: icon,
        });

        markers.push(marker);
        google.maps.event.addListener(marker, "click", function () {
            console.log(this.data);
            openModal(this.data);
            //t.openModal({poi:data});
        });
    }   
    </script>

    
@endsection