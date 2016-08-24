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
}
