<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('admin/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('provinsi',function ($value=''){
	$provinsi = \App\Provinsi::orderBy('kode_provinsi')->get();
	return $provinsi;
});

Route::get('kecamatan',function ($value=''){
	$provinsi = \App\Kecamatan::orderBy('kode_kecamatan')->get();
	return $provinsi;
});



Route::get('/proposal','ProposalCtrl@getIndex');
Route::get('/proposal/periksa','ProposalCtrl@getPeriksaDokumen');

Route::group(array('prefix'=>'proposal'), function(){
	Route::get('/usulan/array','ProposalCtrl@getArrayUsulan');
	Route::get('/usulan','ProposalCtrl@getUsulanList');

	Route::get('/usulan/tambah','ProposalCtrl@getUsulan');
	Route::post('/usulan/tambah','ProposalCtrl@postUsulan');

	Route::get('/usulan/{id}','ProposalCtrl@getUbah');
	Route::post('/usulan/{id}','ProposalCtrl@postUbah');

	Route::post('upload','ProposalCtrl@postUpload');

	Route::get('/pengecekan','PengecekanCtrl@getIndex');
});

Route::group(array('prefix'=>'pengecekan'), function(){
	Route::get('/usulan','PengecekanCtrl@getIndex');
	Route::get('/usulan/{id}','PengecekanCtrl@getUsulan');
	Route::post('/usulan/{id}','PengecekanCtrl@postUsulan');
});

Route::group(array('prefix'=>'persyaratan'), function(){
	Route::get('/jalan','PersyaratanCtrl@getJalan');

	Route::get('/jalan','PersyaratanCtrl@getSab');

	Route::get('/jalan','PersyaratanCtrl@getPlts');
});


Route::group(array('prefix'=>'admin'), function(){
	Route::get('login','AuthCtrl@showLoginForm')->name('login');
	Route::post('login','AuthCtrl@login');
	Route::get('logout','AuthCtrl@logout')->name('logout');
});

Route::group(array('prefix'=>'pengaturan'), function(){
	Route::get('user','UserCtrl@getIndex');
	Route::get('user/tambah','UserCtrl@getTambah');
	Route::post('user/post','UserCtrl@postAddEdit');
	Route::get('user/edit/{id}','UserCtrl@getUbah');
	Route::get('user/hapus/{id}','UserCtrl@postHapus');
	Route::get('user/aktif/{id}','UserCtrl@getAktifnonaktif');
	Route::get('user/gantipassword','UserCtrl@getGantiPassword');
	Route::post('user/gantipassword','UserCtrl@postGantiPassword');

	Route::get('role','RoleCtrl@getIndex');

});

Route::get('/getKabKota/{id}',function ($id=''){
	return DB::table('kabupaten')->where('kode_provinsi',$id)->get();
});

Route::get('/getKecamatan/{id}',function ($id=''){
	return DB::table('kecamatan')->where('kode_kabupaten',$id)->get();
});

Route::get('/getDesa/{id}',function ($id=''){
	return DB::table('desa')->where('kode_kecamatan',$id)->get();
});
