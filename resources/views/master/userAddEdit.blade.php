@extends('layouts.adminlte')


@section('content')
<?php

if(session('aksi') == 'edit'){
	$id = $users->id;
	$username = $users->username;
	$name = $users->name;
	$email = $users->email;
	$password = $users->password;
	$kprovinsi = $users->kode_provinsi;
	$kkabupaten = $users->kode_kabupaten;


	$readonly = 'readonly';
}else{
	$id ='';	
	$username = '';
	$name = '';
	$email = '';
	$password = '';
	$readonly = '';
	$kprovinsi = '';
	$kkabupaten = '';
}
?>

<form role="form" method="POST" enctype="multipart/form-data" action="{{ url('/pengaturan/user/post') }}">
	<div class="row">
		<div class="col-md-8">
			<div class="box box-default">
				<div class="box-header with-border">
					<h6 class="box-title"><i class="fa fa-user"></i> Tambah User</h6>
					<a href="{{ url('pengaturan/user') }}" class="pull-right btn btn-sm btn-primary">
						<i class="fa fa-mail-reply"></i> Kembali</a>
				
				</div>
				<div class="box-body">
					
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="status" value="{{ $status }}">
						
						@if(session('aksi') =='edit')
						<input type="hidden" name="id" value="{{ $id }}">

						@endif
						
						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control" name="username" value="{{ $username }}" {{ $readonly }}>
							<div class="col-md-6">
								
							</div>
						</div>

						<div class="form-group">
							<label>Nama Lengkap</label>
							<input  class="form-control" name="name" type="text" value="{{ $name }}">
							<div class="col-md-6">

							</div>
						</div>

						<div class="form-group">
							<label >Email</label>
							<input type="text" class="form-control" name="email" value="{{ $email }}">
							<div class="col-md-6">
								
							</div>
						</div>
						
						@if($status == 'edit')
						
						<input type="hidden" class="form-control" name="oldpassword" value="{{ $password }}">
							
						@endif

						<div class="form-group">
							<label >Password</label>
							<input type="password" class="form-control" name="password" value="{{ $password }}">
							<div class="col-md-6">
								
							</div>
						</div>

						<div class="form-group{{ $errors->has('provinsi') ? ' has-error' : '' }}">
	                        <label>Provinsi</label>
	                        <select name="provinsi" id="provinsi" class="form-control chosen-select">
	                            <option value="--">----</option>
	                                @foreach($provinsi as $k => $v)
	                                    <option value="{{ $v->kode_provinsi }}" @if($v->kode_provinsi == $kprovinsi) selected @endif>{{$v->provinsi}}</option>
	                                @endforeach
	                        </select>
	                    </div>

	                    <div class="form-group{{ $errors->has('kabupaten') ? ' has-error' : '' }}">
	                        <label>Kabupaten/Kota</label>
	                        <select name="kabupaten" id="kabkota" class="form-control">
	                        </select>
	                    </div>
                      
						<!--<div class="form-group">
							<label>Image</label>
							<input type="file" class="styled" name="image">
							<p class="help-block">Example block-level help text here.</p>
						</div>-->
						<div class="form-group">
							
							<button type="submit" class="btn btn-primary">
								Simpan
							</button>
							
						</div>

					
				</div>
			</div>
		</div>
		<div class="col-md-3">

			<div class="box box-default">
				<div class="box-header with-border">
					<h6 class="box-title"><i class="icon-user"></i> Role</h6>
				</div>
				<div class="box-body">
		            <div class="form-group">
		            	@foreach($role as $k => $v)
		            	<?php $c='';?>
		            	@if(session('aksi')=='edit')
		            	<?php $c = ($users->hasRole($v->name)) ? 'checked': ''; ?>
		            	@endif
		                <div>
		                	<label>
			                  	<input type="radio" class="minimal" name="role" value="{{$v->name}}" {{$c}}>
			                  	{{$v->name}}
			                </label>
		                </div>
		                @endforeach
		            </div>

				</div>
			</div>

			

			

		</div>
	</div>
</form>
@endsection

