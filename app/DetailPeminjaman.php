<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    protected $table='detail_peminjaman';
    protected $primaryKey='id';


    public function subKelompok()
    {
    	return $this->belongsTo(SubKelompok::class,'id_sub');
    }

    public function peminjaman(){
    	return $this->belongsTo(Peminjaman::class,'id_peminjaman');
    }

 //    public function sumJumlah()
	// {
	//     return $this->peminjaman()
	//       ->selectRaw('sum(jumlah) as jumlah')
	//       ->groupBy('id_sub')->select('jumlah');
	// }



}
