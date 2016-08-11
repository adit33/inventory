<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{

protected $table='barang';
protected $primaryKey='idBarang';
public $timestamps=false;
protected $fillable=['namaBarang','idBarang','jumlahBarang','hargaBarang'];

public static $rules=[
	'namaBarang'=>'required',
	'jumlahBarang'=>'required|integer',
	'hargaBarang'=>'required|integer'
];

public static $pesan=[
	'namaBarang.required'=>'Nama Barang Harus di Isi',
	'jumlahBarang.required'=>'Jumlah Barang Harus di Isi',
	'jumlahBarang.integer'=>'Inputan harus bilangan bulat',
	'hargaBarang.required'=>'Harga Barang Harus di Isi',
	'hargaBarang.integer'=>'Inputan harus bilangan bulat',
];

public function getKodeBarang(Request $request){
	$id=$request->input('idBarang');
	$barang=Barang::where('idBarang','=',$id)->get();
	return $barang;
}

}
