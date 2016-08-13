<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubKelompok extends Model
{
    protected $table='subKelompok';
    protected $primaryKey='id_sub';
    protected $fillable=['kode_sub','kelompok_kode','nama_sub','stock'];
    public $timestamps=false;


    public function kelompok()
    {
    	return $this->belongsTo(Kelompok::class,'kelompok_kode');
    }

}
