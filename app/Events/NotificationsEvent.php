<?php

namespace App\Events;

use App\Events\Event;
use Carbon\Carbon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class NotificationsEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        date_default_timezone_set('Africa/Cairo');
        $this->data = array(
            'message'=> $message,
            'at' => Carbon::now()->toDateTimeString()
        );
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['notifications-channel'];
    }
}
