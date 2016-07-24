<?php

namespace App\Listeners;

use App\Events\ActivityDetected;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BroadcastUsers implements ShouldQueue
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
     * @param  ActivityDetected  $event
     * @return void
     */
    public function handle(ActivityDetected $event)
    {
        //
    }
}
