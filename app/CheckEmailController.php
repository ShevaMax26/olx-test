<?php

namespace app;

use App\Services\OlxPrice\EventChannel;
use App\Services\OlxPrice\Publisher;
use App\Services\OlxPrice\Subscriber;

class CheckEmailController
{
    public function __construct(
        private string $url,
        private string $email
    )
    {
    }

    public function handle()
    {
        $olxChanel = new EventChannel();
        $subscriber = new Subscriber($this->email);
        $publisher = new Publisher($this->url, $olxChanel);


        $olxChanel->subscribe($this->url, $subscriber);

        $publisher->publish('9999');
    }
}