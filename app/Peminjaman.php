<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Library\Autonumber;

class Peminjaman extends Model
{
	protected $table='peminjaman';
	protected $primaryKey='id';
	protected $fillable=['id','user_id','is_return'];

    public function getKodePeminjaman(){
        $table="peminjaman";
        $primary="id";
        $prefix="PNJ-";
        $kodeBarang=Autonumber::autonumber($table,$primary,$prefix);
        return $kodeBarang;
    }

    public function detailPeminjaman()
    {
    	return $this->hasMany(DetailPeminjaman::class,'id_peminjaman');
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class,'id_lokasi');
    }

    public function sumJumlah()
	{
	    return $this->detailPeminjaman()
	      ->selectRaw('sum(jumlah) as jumlah')
	      ->groupBy('id_sub');
	}
}
