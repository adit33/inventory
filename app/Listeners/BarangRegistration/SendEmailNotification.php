<?php

namespace App\Listeners\BarangRegistration;

use App\Events\BarangRegistrationEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BarangRegistrationEvent  $event
     * @return void
     */
    public function handle(BarangRegistrationEvent $event)
    {
        //
    }
}
