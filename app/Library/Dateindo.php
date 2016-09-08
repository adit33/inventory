<?php
namespace App\Library;
class Dateindo{
	public static function convertdate(){
		date_default_timezone_set('Asia/Jakarta');
        $date = date('dmy');
        return $date;
	}

	public static function datenow(){
		date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        return $date;
	}
}

?>