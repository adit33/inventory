<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\permission;

Route::get('/', function () {
    return view('welcome');
});
Route::get('login',array('uses'=>'UserController@login'));
Route::POST('login',array('uses'=>'UserController@doLogin'));
Route::get('404',function(){
	return View('errors.404');
});
//Route::resource('barang','BarangController');
Route::group(['middleware'=>'admin'],function(){

Route::get('role/create',['uses'=>'RoleController@create']);
Route::POST('role/store',['uses'=>'RoleController@store','as'=>'role.store']);
Route::get('role/edit/{id}',['uses'=>'RoleController@edit']);
Route::PUT('role/update',['uses'=>'RoleController@update','as'=>'role.update']);

Route::get('permission/create',['uses'=>'PermissionController@create']);

Route::get('user/create',['uses'=>'UserController@create']);
Route::POST('user/store',['uses'=>'UserController@store','as'=>'user.store']);
Route::get('user/edit/{id}',['uses'=>'UserController@edit','as'=>'user.edit']);
Route::POST('user/update/{id}',['uses'=>'UserController@update','as'=>'user.update']);

Route::get('api/barang',array('uses'=>'BarangController@apiBarang'));
Route::get('barang',['uses'=>'BarangController@index']);
Route::POST('barang/store',array('uses'=>'BarangController@store'));
Route::get('api/getidBarang',array('uses'=>'BarangController@getKodeBarang'));

Route::get('suplier/create',['uses'=>'SuplierController@create']);
Route::POST('suplier/store',['uses'=>'SuplierController@store','as'=>'suplier.store']);


Route::POST('penjualan/store',['uses'=>'PenjualanController@store','as'=>'penjualan.store']);
Route::get('penjualan/create',['uses'=>'PenjualanController@create']);
Route::get('penjualan/apibarang',['uses'=>'PenjualanController@apiBarang','as'=>'penjualan.data']);
Route::get('penjualan/getId',['uses'=>'PenjualanController@getId']);
ROute::get('penjualan/cart',['uses'=>'PenjualanController@datacart','as'=>'cart.data']);
Route::get('penjualan/deletecart',['uses'=>'PenjualanController@deletecart']);
Route::POST('penjualan/editcart',['uses'=>'PenjualanController@editcart']);
Route::get('penjualan/getplg',['uses'=>'PenjualanController@getPelanggan']);
Route::get('laporan',['uses'=>'PenjualanController@laporan']);
Route::get('getlaporan',['uses'=>'PenjualanController@getlaporan']);
Route::get('exportpdf',['uses'=>'PenjualanController@exportpdf']);
Route::get('chart',['uses'=>'PenjualanController@chart']);
Route::get('getdatachart',['uses'=>'PenjualanController@getdatachart']);

});


Route::get('user/store',array('uses'=>'UserController@store'));
Route::get('logout',array('uses'=>'UserController@logout'));
