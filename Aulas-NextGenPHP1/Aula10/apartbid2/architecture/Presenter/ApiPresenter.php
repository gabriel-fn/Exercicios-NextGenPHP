<?php

namespace Architecture\Presenter;

use Architecture\Presenter\Interface\PresenterInterface;
use Psr\Http\Message\ResponseInterface;

class ApiPresenter implements PresenterInterface
{
    public function __construct(
        protected PresenterInterface $strategy
    ) {
    }

    public function output(object $response, int $statusCode = 200): ResponseInterface
    {
        return $this->strategy->output($response, $statusCode);
    }
}
