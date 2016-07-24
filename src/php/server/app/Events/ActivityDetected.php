<?php

namespace App\Events;

use App\Eloquent\Activity;
use App\Events\Event;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class ActivityDetected extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $activity;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Activity $activity)
    {
        $this->activity = $activity;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['public'];
    }

    public function broadcastAs()
    {
        return 'activity.detected';
    }
}
