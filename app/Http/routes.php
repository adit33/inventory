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

Route::get('coba',function(){
   return dd(DB::table('subKelompok')->whereIn('id_sub',[5,2,1,3])->lists('nama_sub','id_sub'));
});

Route::get('/', function () {
	// $lokasis=DB::table('lokasi')
 //    ->join('peminjaman','lokasi.id','=','peminjaman.id_lokasi','left outer')
 //    ->join('detail_peminjaman','peminjaman.id','=','detail_peminjaman.id_peminjaman','left outer')
 //    ->get();
    $lokasis=App\Lokasi::with(['peminjaman','peminjaman'=> function ($query){
        $query->where('is_approve','=','false');
    },
    'peminjaman.detailPeminjaman'=>function($query){
        $query->groupBy('id_sub');
    },
    'peminjaman.detailPeminjaman.subKelompok'])->get();

    $config = array();
    $config['zoom'] = 'auto';
    $config['center'] = 'auto';
    $config['onboundschanged'] = 'if (!centreGot) {
            var mapCentre = map.getCenter();
            marker_0.setOptions({
                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
            });
        }
        centreGot = true;';

    Gmaps::initialize($config);

    // set up the marker ready for positioning
    // once we know the users location

    // foreach ($lokasis as $lokasi) {
    // 	$marker = array();
    // 	$marker['position']=$lokasi->lat.','.$lokasi->lang;
    // 	$marker['infowindow_content']=$lokasi->nama."<hr><strong>Alamat : parung halang<br><strong>Kode Pos : </strong> 40375 <br><strong>Telp : </strong> 089656234771";
    // 	Gmaps::add_marker($marker);
    // }
$data_sub=[];
$marker = array();
    foreach ($lokasis as $lokasi) {
        $x[$lokasi->id]=null;
        $data[$lokasi->id]=null;
        foreach ($lokasi->peminjaman as $peminjaman) {
             if($peminjaman == null){$data[$lokasi->id]=null;}
             $jumlah=$peminjaman->first()->sumJumlah;
            foreach ($peminjaman->detailPeminjaman as $subkelompok) {
            $data_sub[]='<hr><strong>'.$subkelompok->subkelompok->nama_sub.' jumlah pinjam '.$jumlah.'</strong><br>';
                    $data[$lokasi->id]=implode("",$data_sub);   
                 //   echo dd($jumlah);                  
            }
        }
    }

    // echo dd($data);
    $sub=$data+$x;

    foreach ($lokasis as $lokasi) {
        $marker['position']=$lokasi->lat.','.$lokasi->lang;
        $marker['infowindow_content']=$lokasi->nama.$sub[$lokasi->id];  
        Gmaps::add_marker($marker);
    }


    $map = Gmaps::create_map();
    echo "<html><head>
<script type='text/javascript'>var centreGot = false;</script>".$map['js']."</head><body>".$map['html']."</body></html>";
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

Route::resource('user','UserController');

Route::resource('lokasi','LokasiController');

Route::get('subkelompok',['uses'=>'SubKelompokController@index','as'=>'sub.index']);

Route::get('peminjaman',['uses'=>'PeminjamanController@index','as'=>'peminjaman.index']);
Route::get('peminjaman/create',['uses'=>'PeminjamanController@create','as'=>'peminjaman.create']);
Route::POST('peminjaman/store',['uses'=>'PeminjamanController@store','as'=>'peminjaman.store']);
Route::get('peminjaman/getsubkelompok',['uses'=>'PeminjamanController@getSubKelompok','as'=>'get.sub']);
Route::get('peminjaman/view/{id}',['uses'=>'PeminjamanController@show','as'=>'peminjaman.view']);

Route::POST('peminjaman/addcart',['uses'=>'PeminjamanController@addCart','as'=>'cart.add']);

Route::get('get_id_sub_kelompok',['uses'=>'SubKelompokController@getSubKelompok','as'=>'subkelompok.getid']);

Route::get('get_data_sub_kelompok',['uses'=>'SubKelompokController@getDataSubKelompok','as'=>'subkelompok.getdata']);

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
