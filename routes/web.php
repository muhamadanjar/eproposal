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

//Auth::routes();

Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login','Auth\LoginController@login');
Route::post('logout','Auth\LoginController@logout')->name('logout');

Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('password/reset','Auth\ResetPasswordController@reset');
Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::get('password/reset','Auth\ResetPasswordController@showResetForm')->name('password.request');
Route::get('register','Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register','Auth\RegisterController@register');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('provinsi',function ($value=''){
	$provinsi = \App\Provinsi::orderBy('kode_provinsi')->get();
	
	return view('provinsi.provinsiList')->with('provinsi',$provinsi);
});
Route::get('kecamatan',function ($value=''){
	$kecamatan = \App\Kecamatan::orderBy('kode_kecamatan')->get();
	return view('provinsi.kecamatanList')->with('kecamatan',$kecamatan);
});


Route::get('/proposal','ProposalCtrl@getIndex');
Route::get('/proposal/periksa','ProposalCtrl@getPeriksaDokumen');

Route::group(['prefix'=>'proposal'], function(){
	Route::get('/usulan/array','ProposalCtrl@getArrayUsulan');
	Route::get('/usulan','ProposalCtrl@getUsulanList');

	Route::get('/usulan/tambah','ProposalCtrl@getUsulan');
	Route::post('/usulan/tambah','ProposalCtrl@postUsulan');

	Route::get('/usulan/{id}','ProposalCtrl@getUbah');
	Route::post('/usulan/{id}','ProposalCtrl@postUbah');

	Route::post('upload','ProposalCtrl@postUpload');

	Route::get('/pengecekan','PengecekanCtrl@getIndex');
});

Route::group(['prefix'=>'pengecekan'], function(){
	Route::get('/usulan','PengecekanCtrl@getIndex');
	Route::get('/usulan/{id}','PengecekanCtrl@getUsulan');
	Route::post('/usulan/{id}','PengecekanCtrl@postUsulan');
});

Route::group(['prefix'=>'persyaratan'], function(){
	Route::get('/jalan/array','PersyaratanCtrl@getArrayJalan');
	Route::get('/sab/array','PersyaratanCtrl@getArraySab');
	Route::get('/plts/array','PersyaratanCtrl@getArrayPlts');

	Route::get('/jalan','PersyaratanCtrl@getJalan');
	Route::get('/sab','PersyaratanCtrl@getSab');
	Route::get('/plts','PersyaratanCtrl@getPlts');
});

Route::group(['prefix'=>'laporan'], function(){
	Route::get('/usulan','LaporanCtrl@getUsulan');
});


Route::group(['prefix'=>'admin'], function(){
	Route::get('login','AuthCtrl@showLoginForm')->name('login');
	Route::post('login','AuthCtrl@login');
	Route::get('logout','AuthCtrl@logout')->name('logout');
});

Route::group(['prefix'=>'pengaturan'], function(){
	Route::get('user','UserCtrl@getIndex');
	Route::get('user/tambah','UserCtrl@getTambah');
	Route::post('user/post','UserCtrl@postAddEdit');
	Route::get('user/edit/{id}','UserCtrl@getUbah');
	Route::get('user/hapus/{id}','UserCtrl@postHapus');
	Route::get('user/aktif/{id}','UserCtrl@getAktifnonaktif');
	Route::get('user/gantipassword','UserCtrl@getGantiPassword');
	Route::post('user/gantipassword','UserCtrl@postGantiPassword');
	Route::get('notify/{id}', ['as' => 'notify',   'uses' => 'UserCtrl@notifyJedi']);
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
