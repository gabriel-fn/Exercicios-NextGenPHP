<?php

namespace Architecture\Presenter\Interface;

use Psr\Http\Message\ResponseInterface;

interface PresenterInterface
{
    public function output(object $response, int $statusCode = 200): ResponseInterface;
}
