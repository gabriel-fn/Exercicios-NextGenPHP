<?php

namespace Architecture\Controller;

use Architecture\Application\DTO\RentalBidDTO;
use Architecture\Application\UseCase\Interface\CommandHandler;
use Architecture\Application\UseCase\RentalBid\CreateRentalBidUseCase;
use Architecture\Presenter\Interface\PresenterInterface;
use Laminas\Hydrator\HydratorInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RentalBidController
{
    public function __construct(
        protected PresenterInterface $presenter,
        protected CreateRentalBidUseCase $createRentalBid,
        protected HydratorInterface $hydrator
    ) {
    }

    public function create(ServerRequestInterface $request): ResponseInterface
    {
        try {
            // fazer a camada de input tratando \ gravar video sobre PSR7 com Request
            // $rentalBidDTO = $this->input->handle($request, ['campo' => 'integer:notnull']);
            $rentalBidDTO = $this->hydrator->hydrate((array)$request->getParsedBody(), new RentalBidDTO());

            $this->createRentalBid->setInput($rentalBidDTO);
            $savedRentalBid = $this->createRentalBid->execute();

            return $this->presenter->output($savedRentalBid, 201);
        } catch (\Exception $e) {
            return $this->presenter->output((object)['error' => $e->getMessage()], 400);
        }
    }
}
