<?php

namespace Architecture\Presenter;

use Architecture\Presenter\Interface\PresenterInterface;
use JsonException;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class JsonPresenterStrategy implements PresenterInterface
{
    /**
     * @throws JsonException
     */
    public function output(object $response, int $statusCode = 200): ResponseInterface
    {
        $responsePsr = new Response();

        $response = [
            'data' => $response
        ];

        $responsePsr->getBody()->write(json_encode($response, JSON_THROW_ON_ERROR, 1024));
        return $responsePsr->withStatus($statusCode)
                           ->withHeader('Content-Type', 'application/json');
    }
}
