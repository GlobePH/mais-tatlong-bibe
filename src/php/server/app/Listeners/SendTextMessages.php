<?php

namespace App\Listeners;

use App\Eloquent\Access;
use App\Events\ActivityDetected;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class SendTextMessages
{
    protected $shortCode = '21584527';

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
        $messenger = (new \App\Globe\GlobeApi('v1'))->sms($this->shortCode);
        foreach (Access::all() as $access) {
            //$messenger->sendMessage($access->token, $access->mobile_no, $event->activity->description);    
        }
    }
}
