<?php

namespace App\Http\Exceptions;

class HttpException extends \Exception
{
    private int $statusCode = 404;

    public function setStatusCode(int $statusCode): HttpException
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}