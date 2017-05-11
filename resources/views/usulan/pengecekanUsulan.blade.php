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
  <form>
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
                      <small class="pull-right">Date: {{$usulan->created_at}}</small>
                    </h2>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                    
                    <address>
                      <strong>Admin, Inc.</strong><br>
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
                      {{$usulan->jumlah_usulan}}<br>
                      
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    <b>Usulan #{{$usulan->tahun_usulan}}{{ rand() }}{{$usulan->user_id}}</b><br>
                    <br>
                    <b>Pengusulan:</b> {{$usulan->jenis_usulan}}<br>
                    <b>Tahun:</b> {{$usulan->tahun_usulan}}<br>
                    <b>User:</b> {{$usulan->user_id}}
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

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
                        
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($usulan->pjalan as $k => $v)
                      <tr>
                        <td>{{$v->no}}</td>
                        <td>{{$v->namausulan}}</td>
                        <td>{{$v->isi}}</td>
                        <td><input type="checkbox" name="verifikasi[{{$k}}]" value="1"></td>
                        
                      </tr>
                      @endforeach
                      
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-xs-6">
                    <p class="lead">Payment Methods:</p>
                    <img src="../../dist/img/credit/visa.png" alt="Visa">
                    <img src="../../dist/img/credit/mastercard.png" alt="Mastercard" data-pin-nopin="true">
                    <img src="../../dist/img/credit/american-express.png" alt="American Express" data-pin-nopin="true">
                    <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                      Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
                      dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                    </p>
                  </div>
                  <!-- /.col -->
                  <div class="col-xs-6">
                    <p class="lead">Amount Due 2/22/2014</p>

                    <div class="table-responsive">
                      <table class="table">
                        <tbody><tr>
                          <th style="width:50%">Subtotal:</th>
                          <td>$250.30</td>
                        </tr>
                        <tr>
                          <th>Tax (9.3%)</th>
                          <td>$10.34</td>
                        </tr>
                        <tr>
                          <th>Shipping:</th>
                          <td>$5.80</td>
                        </tr>
                        <tr>
                          <th>Total:</th>
                          <td>$265.24</td>
                        </tr>
                      </tbody></table>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-xs-12">
                    <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                    <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
                    </button>
                    <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                      <i class="fa fa-download"></i> Generate PDF
                    </button>
                  </div>
                </div>        
            </div>
            
        </div>
        
    </div>
  </div>
  </form>
	<section class="invoice">
      
    </section>

@endsection