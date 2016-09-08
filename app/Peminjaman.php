<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Library\Autonumber;

class Peminjaman extends Model
{
	protected $table='peminjaman';
	protected $primaryKey='id';
	protected $fillable=['id','user_id','is_return','is_approve','id_lokasi'];

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

    public function getSubBarang($id_lokasi)
    {
        $data=[];
        $peminjamans=Peminjaman::with(['detailPeminjaman.subKelompok','detailPeminjaman'=>function($query){
            $query->groupBy('id_sub');
        }])->where('id_lokasi','=',$id_lokasi)->selectRaw(['sum(detailpeminjaman.jumlah as jum'])->get();
        foreach ($peminjamans as $peminjaman) {

            foreach ($peminjaman->detailPeminjaman as $detailpeminjaman) {
                // $detailpeminjaman; 
            }
        }
         return $peminjamans;
    }

    public function sumJumlah()
	{
	    return $this->detailPeminjaman()
	      ->selectRaw('id_sub as jumlah')
	      ->groupBy('id_sub');
	}
}
