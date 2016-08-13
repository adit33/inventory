<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table='lokasi';
    protected $fillable=['nama','lat','lang'];
    public $timestamps=false;
    protected $primaryKey='id';
}
