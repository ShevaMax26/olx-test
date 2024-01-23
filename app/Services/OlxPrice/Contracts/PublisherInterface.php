<?php

namespace App\Services\OlxPrice\Contracts;

interface PublisherInterface
{
    public function publish(int $price): void;
}