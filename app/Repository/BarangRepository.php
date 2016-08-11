<?php 
namespace App\Repository;
use App\Barang;
class BarangRepository implements BarangRepositoryInterface{

	public function apiBarang(){
		$barang=Barang::all();
		return $barang;
	}

}

?>