<?php

namespace App\Events;

use App\Events\Event;
use DB;
use App\Barang;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BarangRegistrationEvent extends Event implements ShouldBroadcast
{
 //   use SerializesModels;


    public $barang=array();

    public function __construct($barang)
    {
        $this->barang=$barang;
    }
 
    public function broadcastOn()
    {
        return ['barang_registration'];
    }

}
