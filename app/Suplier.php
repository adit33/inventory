<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
	protected $table="suplier";
	protected $primaryKey="idSuplier";
	protected $fillable=['idSuplier','namaSuplier','alamatSuplier','telpSuplier'];
	public $timestamps=false;
    //
}
