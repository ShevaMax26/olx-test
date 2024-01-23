<?php

namespace App\Services\OlxPrice;

use App\Services\OlxPrice\Contracts\EventChannelInterface;
use App\Services\OlxPrice\Contracts\PublisherInterface;

class Publisher implements PublisherInterface
{
    public function __construct(
        private string $product,
        private EventChannelInterface $eventChannel
    ){
    }

    public function publish(int $price): void
    {
        $this->eventChannel->publish($this->product, $price);
    }
}