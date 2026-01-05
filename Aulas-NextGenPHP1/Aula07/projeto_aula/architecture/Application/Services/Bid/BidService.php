<?php
/*
namespace Services\Bid;

use App\Models\Bid;
use architecture\Services\Bid\BidDTO;

class BidService
{
    public function __construct(
        // dependencias
    ) {
    }

    /**
     * @param BidDTO $bidDTO
     * @return void
     * @throws \Exception
     */
    public function update(BidDTO $bidDTO)
    {
        try {
            // Ação do Bid
            $result = $this->find(['id' => $bidDTO->getId()], $bidDTO);
            if (false === $result) {
                throw new \Exception("Bid not found");
            }

            // ação de atualização
            $this->bidRepository->save($bidDTO);

            // Unity Of Work
            $this->bidRepository->flush();
        }
    }

    public function find($bidId)
    {

    }

    public function makeABid(MakeBidDTO $makeBidDTO): Bid
    {
        // new ValueObject\String('valore', 2, 100);
        // new ValueObject\Identity('asd1234-12312-141241');
        // makeBidDTO ( bid(String name, ValueObject/Price $price, description, ValueObject\Identity user_id) )
        $this->repository->setCollection('users');
        $this->repository->setReturnMapper(mappedObject: UserOutputDTO::class);
        $users = $this->userRepository->getAll();

        $this->repository->setCollection('users');
        $this->repository->setReturnMapper();
        $users = $this->userRepository->getAll();

        $user = $this->userService->get($makeBidDTO->getUserId());
        if (false === $user) {
            throw new \Exception("User not found");
        }

        // Camada de Domínio eu isolo as regras de negocios
        $bidModel = new Architectecture\Domain\Model\Bid(123, $user);
        $bidModel->setUserBidValue($makeBidDTO->getUserBidPrice());

        // Lança exception se violar regras de negócios
        // para ser tratada
        $bidModel->makeABid($makeBidDTO);

        $this->bidRepository->save($makeBidDTO);

        $makeBidDTO->user = $user;

        return $makeBidDTO;
    }
}
