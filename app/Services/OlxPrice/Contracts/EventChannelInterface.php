<?php

namespace App\Services\OlxPrice\Contracts;

interface EventChannelInterface
{
    public function publish(string $product, int $price): void;

    public function subscribe(string $product, SubscriberInterface $subscriber): void;
}