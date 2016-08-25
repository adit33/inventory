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
}
