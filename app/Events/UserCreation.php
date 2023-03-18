<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserCreation
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private User $user;
    /**
     * Create a new event instance.
     */
    public function __construct(User $user)
    {
        $this->setUser($user);
    }

    public function setUser(User $user): void
    {
         $this->user = $user;
    }

    public function getUser(): user
    {
        return $this->user ;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
