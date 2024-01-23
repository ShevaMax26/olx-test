<?php

namespace App\Services\OlxPrice\Contracts;

interface SubscriberInterface
{
    public function notify(int $price): void;

    public function getEmail(): string;
}