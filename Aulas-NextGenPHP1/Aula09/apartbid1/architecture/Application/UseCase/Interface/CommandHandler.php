<?php

namespace Architecture\Application\UseCase\Interface;

interface CommandHandler
{
    public function execute(): object;
}
