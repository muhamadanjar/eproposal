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

	<table id="table_pplts" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>Usulan</th>
                <th>Tipe Usulan</th>
            </tr>
        </thead>
        <tbody>
        	
        </tbody>
    </table>

@endsection