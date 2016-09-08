<?php

namespace App;
use App\Pelanggan;
use App\Detailjual;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    //
protected $table="jual";
public $timestamps=false;
protected $fillable=["kodeJual","userId","tgl"];
protected $primaryKey="kodeJual";

public function r_pelanggan(){
	return $this->belongsTo('App\Pelanggan','idPelanggan');
}

public function r_detail(){
	return $this->hasMany('App\Detailjual','kodeJual');
}

public function r_barang(){
		return $this->belongsTo('App\Barang','idBarang');
	}

}
