<?php

namespace App\Services\OlxPrice;

use App\Services\OlxPrice\Contracts\EventChannelInterface;
use App\Services\OlxPrice\Contracts\SubscriberInterface;

class EventChannel implements EventChannelInterface
{
    private array $products = [];

    public function subscribe(string $product, SubscriberInterface $subscriber): void
    {
        $this->products[$product][] = $subscriber;

        echo "{$subscriber->getEmail()} підписаний(а) на [{$product}]";
    }

    public function publish(string $product, int $price): void
    {
        if (empty($this->products[$product])) {
            return;
        }

        /** @var SubscriberInterface $subscriber */
        foreach ($this->products[$product] as $subscriber) {
            $subscriber->notify($price);
        }
    }
}