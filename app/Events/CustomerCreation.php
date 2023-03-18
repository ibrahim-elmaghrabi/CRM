<?php

namespace App\Events;

use App\Models\Customer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CustomerCreation
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Customer $customer ;
    /**
     * Create a new event instance.
     */
    public function __construct(Customer $customer)
    {
        $this->setCustomer($customer);
    }

    public function setCustomer(Customer $customer):void
    {
        $this->customer = $customer;
    }

    public function getCustomer(): customer
    {
        return $this->customer;
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
