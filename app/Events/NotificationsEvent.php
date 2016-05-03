<?php

namespace App\Events;

use App\Events\Event;
use Carbon\Carbon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Notification;


class NotificationsEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $user)
    {
        date_default_timezone_set('Africa/Cairo');
        $date = Carbon::now()->toDateTimeString();
        $notification = new Notification();
        $notification->message = $message;
        $notification->user_id = $user->id;
        $notification->read = false;
        $notification->save();
        $this->data = array(
            'message'=> $message,
            'at' => $notification->created_at
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
