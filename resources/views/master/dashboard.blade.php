@extends('layouts.adminlte')
@section('assets-contentheader')
  <h1>Dashboard</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    </ol>
  <div class="rt-clock">
      <span class="date"></span>&nbsp;
      <span class="hours">00</span>:
      <span class="minutes">00</span>:
      <span class="seconds">00</span>
  </div>
@endsection

@section('content')
  <div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-info"></i> Info!</h4>
    Ada {{$jumlah_usulan}} Kegiatan..
  </div>
  
  <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-road"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jalan</span>
              <span class="info-box-number">Rp. {{number_format(($totaljalan[0]->total*1000000),2,",",".")}}</span>
            </div>
        
          </div>
        
        </div>
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-tint"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">SAB</span>
              <span class="info-box-number">Rp. {{number_format(($totalsab[0]->total*1000000),2,",",".")}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        
        <div class="clearfix visible-sm-block"></div>

        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-bolt"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PLTS</span>
              <span class="info-box-number">Rp. {{number_format(($totalplts[0]->total*1000000),2,",",".")}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-building"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Lainnya</span>
              <span class="info-box-number">{{number_format(($totalplts[0]->total*1000000),2,",",".")}}</span>
            </div>
          
          </div>
        </div>

        <div class="clearfix visible-sm-block"></div>
  </div>

  <div class="row">
    <div class="col-md-8">
      <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Gallery</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            
            <div class="box-body">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="4" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="5" class=""></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="{{ asset('images/1.jpg')}}" alt="First slide">
                    <div class="carousel-caption">
                      Slide 1
                    </div>
                  </div>
                  <div class="item ">
                    <img src="{{ asset('images/2.jpg')}}" alt="Second slide">

                    <div class="carousel-caption">
                      Slide 2
                    </div>
                  </div>
                  <div class="item">
                    <img src="{{ asset('images/3.jpg')}}" alt="Third slide">
                    <div class="carousel-caption">
                      Slide 3
                    </div>
                  </div>
                  <div class="item">
                    <img src="{{ asset('images/4.jpg')}}" alt="Third slide">
                    <div class="carousel-caption">
                      Slide 4
                    </div>
                  </div>
                  <div class="item">
                    <img src="{{ asset('images/5.jpg')}}" alt="Third slide">
                    <div class="carousel-caption">
                      Slide 5
                    </div>
                  </div>
                  <div class="item">
                    <img src="{{ asset('images/6.jpg')}}" alt="Third slide">
                    <div class="carousel-caption">
                      Slide 6
                    </div>
                  </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
            </div>
      </div>
    </div>
    <div class="col-md-4">
      
      <div class="box box-primary">
          <div class="box-header with-border">
              <h3 class="box-title">Berita</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
          </div>
            <!-- /.box-header -->
          <div class="box-body">
              <ul class="products-list product-list-in-box">
                <li class="item">
                  <div class="product-img">
                    <img src="dist/img/default-50x50.gif" alt="Berita Image" data-pin-nopin="true">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">---
                      <span class="label label-warning pull-right">--</span>
                    </a>
                    <span class="product-description">
                      ------
                    </span>
                  </div>
                </li>
              </ul>
          </div>
          
      </div>
    </div>
  </div>

  <div id="map"></div>



  
 
  
  
@endsection

@section('js_tambahan')
<script>
      function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUFQ_PdoGGeFoaimy-7AMAicWHQ3EGp3U&callback=initMap">
    </script>

    
@endsection