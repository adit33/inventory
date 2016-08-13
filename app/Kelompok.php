<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    protected $table='kelompok';
    protected $fillable=['kode_kelompok','nama_kelompok','stok'];
    public $timestamps=false;
    protected $primaryKey='id_kelompok';
}
