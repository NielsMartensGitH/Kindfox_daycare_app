<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewComment implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $username;

    public $message;

    public $users;
    public $model_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $username, array $users, $model_id)
    {
        $this->username = $username;
        $this->users = $users;
        $this->model_id = $model_id;
        $this->message  = "{$username} added new comment";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return ['new-comment'];
    }
}