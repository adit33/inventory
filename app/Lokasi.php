<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table='lokasi';
    protected $fillable=['nama','lat','lang'];
    public $timestamps=false;
    protected $primaryKey='id';
 
 public function peminjaman()
    {
    	return $this->hasMany(Peminjaman::class,'id_lokasi');
    }

}


