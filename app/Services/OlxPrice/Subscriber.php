<?php

namespace App\Services\OlxPrice;

use App\Services\OlxPrice\Contracts\SubscriberInterface;

class Subscriber implements SubscriberInterface
{
    public function __construct(
        private string $email
    ){
    }

    public function notify(int $price): void
    {
        echo "Користувач: ' . $this->email . ' отримав зміну ціни ' . $price";
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}