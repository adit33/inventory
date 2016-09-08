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

    public function getSubBarang($id)
    {
        $barangs=DetailPeminjaman::with('subKelompok')->where('id_peminjaman','=',$id)->get();


        $data_sub=[];
        $jumlah=0;
        foreach ($barangs as $barang) {
            $jumlah=$barang->jumlah;
            array_push($data_sub,$barang->subKelompok->nama_sub.' di pinjam '.$barang->jumlah.'<br>');
        }

        return $data_sub;
    }

    public function sumBarang($id)
    {
        $jumlah=DetailPeminjaman::where('id_sub','=',$id)->sum('jumlah');
        return $jumlah;
    }

    public function sumJumlah()
	{
	    return $this
	      ->selectRaw('sum(jumlah) as jumlah')
	      ->groupBy('id_sub')->select('jumlah');
	}


}
