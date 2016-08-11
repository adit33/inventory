<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detailjual extends Model
{
    protected $table="detail_jual";
    protected $primaryKey="id";
    public $timestamps=false;
    protected $fillable=["id","idBarang","jumlah","kodeJual"];
    
	
	public function r_jual(){
	return $this->belongsTo('App\Penjualan','kodeJual');
	}

	public function r_barang(){
		return $this->belongsTo('App\Barang','idBarang');
	}

}

