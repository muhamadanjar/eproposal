@extends('layouts.adminlte')
@section('title','User')
@section('page-header')
	<div class="page-header">
		<div class="page-title">
			<h3>User <small>List user</small></h3>
		</div>

		<div id="reportrange" class="range">
			<div class="visible-xs header-element-toggle">
				<a class="btn btn-primary btn-icon"><i class="fa fa-mail-reply"></i></a>
			</div>
			<div class="date-range"></div>
			<span class="label label-danger">9</span>
		</div>
	</div>
@endsection

@section('breadcrumb')
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href="#">Home</a></li>
		<li><a href="#">Master</a></li>
		<li class="active">User</li>
	</ul>
	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>
</div>
@endsection
@section('content')
	<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="box box-default">
				
				<div class="box-header with-border">
					<h6 class="box-title"><i class="icon-user"></i> Daftar User</h6>
					<a href="{{ url('pengaturan/user/tambah') }}" class="pull-right btn btn-sm btn-primary">
						<i class="fa fa-plus"></i> Tambah</a>
				</div>
				<div class="box-body no-padding">
		            
		            
					<table class="table table-hover table-bordered">
						<tr>
							<th>Username</th>
							<th>Email</th>
							<th>Nama</th>
							<th>Aksi</th>
						</tr>
						
						@foreach($users as $key => $v)
                        <?php $class_active = ($v->isactive==0) ? 'btn-danger':'btn-info' ?>
                        <?php $fa_active = ($v->isactive==0) ? 'fa-circle':'fa-circle-o' ?>

						<tr>
							<td>{{ $v->username }}</td>
							<td>{{ $v->email }}</td>
							<td>{{ $v->name }}</td>
							<td>
								<div class="btn-group">
					                <button data-toggle="dropdown" class="btn {{ $class_active }} btn-icon dropdown-toggle" type="button"><i class="icon-cog4"></i><span class="caret"></span></button>
									<ul class="dropdown-menu icons-right dropdown-menu-right">
										<li><a href="{{ url('pengaturan/user/edit', ['id' => $v->id]) }}"><i class="fa fa-edit"></i> Ubah</a></li>
										<li data-form="#frm-{{$v->id}}" 
											data-title="Hapus {{ $v->id }}" 
											data-message="Apa anda yakin menghapus {{ $v->username }} ?">
											<a class= "formConfirm" href="#"><i class="fa fa-trash"></i> Hapus</a>
										</li>
										<form action="{{ url('pengaturan/user/hapus', array($v->id) ) }}" method="post" style="display:none" id="frm-{{$v->id}}">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
										</form>
                                        <li data-form="#frmaktif-{{$v->id}}" 
											data-title="Aktif {{ $v->id }}" 
											data-message="Apa anda yakin mengaktifkan/menonaktifkan {{ $v->username }} ?">
											<a class= "formConfirm" href="#"><i class="fa {{$fa_active}}"></i> Aktif / Non Aktif</a>
										</li>
										<form action="{{ url('pengaturan/user/aktif', array($v->id) ) }}" method="get" style="display:none" id="frmaktif-{{$v->id}}"></form>					
									</ul>
				                </div>
							</td>
						</tr>
						@endforeach
					</table>
                    
                    
				</div>
				<div class="box-footer clearfix">
					*) Merah = Non AKtif || Biru = Aktif
					
	              	
	            </div>
			</div>
		</div>
	</div>
@endsection