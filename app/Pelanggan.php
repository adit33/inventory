<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    //
public $timestamps=false;
protected $table="pelanggan";
protected $primaryKey="idPelanggan";

public function r_jual(){
	return $this->hasMany('App\Penjualan');
}
}
