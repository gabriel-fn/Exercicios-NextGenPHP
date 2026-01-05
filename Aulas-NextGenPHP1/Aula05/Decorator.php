<?php

class SaveUserUseCase
{
    public function execute()
    {
        // ... implementação
    }
}

class UserController implements UserControllerActionsInterface
{
    // contrutor ...
    protected SaveUserUseCase $saveUserUseCase;

    public function save(): Response
    {
        return $this->saveUserUseCase->execute();
    }
}

class LogDecorator
{
    public function __construct(
        protected UserController $userController
    ) {
    }

    // Ação de decoração
    public function save(): Response
    {
        // antes
        $result = $this->userController->save();
        $this->logger->log('acção depois do save original do controller');
        return $result;
    }
}

// container de injeção
$userControllerDecorator = new LogDecorator(new UserController(new SaveUserUseCase));
