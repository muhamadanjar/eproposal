<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name') }} | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/square/blue.css')}}">
  <style type="text/css">
    html { 
      background: url({{ url('assets/images/bg_login.png') }}) no-repeat center center fixed;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }

    #trans{
      
      margin: auto;
      width: 100%;
      padding: 10px;
    }
    #trans img{
      position: absolute;
      top: 70%;
      left: 35%;
      width: 70%;
      height: 60%;
      margin-top: -250px; /* Half the height */
      margin-left: -250px;
      opacity: 0.5;
      filter: alpha(opacity=50); /* For IE8 and earlier */
    }
    .logo-box {
      position: absolute;
      width: 330px;
      right: 10%;
      top: 30%;
      
    }

    .login-box, .register-box {
      width: 330px;
      padding-top: 9%;
      margin: auto 5%;
    }

    .login-box-body, .register-box-body {
      background: rgba(0, 0, 0, 0.5);
      padding: 20px;
      border-top: 0;
      color: #666;
      
    }

    .login-box-body .title{
      color: #fff;
      font-size: 20px;
      margin: 0;
      text-align: center;
      padding: 0 20px 20px 20px;
      opacity: 1;
    }

    .login-box-body label{
      color: #fff;
      font-size: 14px;
    }

    .login-page, .register-page {
        background: none;
    }

    .img-logo {
        margin: 0 auto;
        width: 250px;
        padding: 3px;
        
    }
  </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="logo-box">
  <div class="logo-img">
    <img class="img-logo img-responsive" width="70%" src="{{ asset('assets/images/logo_kemendes_login.png')}}" alt="User profile picture" data-pin-nopin="true">
  </div>
</div>
<div class="login-box">
  <div class="login-logo">
    <img class="img-logo img-responsive" width="70%" src="{{ asset('assets/images/logo_login.png')}}" alt="User profile picture" data-pin-nopin="true">
  </div>
  
  <div class="login-box-body">
    <p class="login-box-msg"></p>
    <div class="title">E-Proposal Kemendes</div>
    
    <form method="post" action="{{ url('/admin/login') }}">
      {{ csrf_field() }}
      <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        
      </div>
      <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

       
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember"> Ingat saya
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!--<div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Login dengan
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Login dengan
        Google+</a>
    </div>-->
    <!-- /.social-auth-links -->

    <a href="#">Lupa Password</a><br>
    <!--<a href="{{ url('register')}}" class="text-center">Daftar a user baru</a>-->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="{{ asset('assets/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{ asset('assets/plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
