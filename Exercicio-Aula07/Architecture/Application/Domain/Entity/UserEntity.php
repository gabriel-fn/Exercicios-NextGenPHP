<?php

declare(strict_types=1);

namespace Architecture\Application\Domain\Entity;

class UserEntity 
{
    public int $id;
    public string $name;
    public string $email;
    public ?string $email_verified_at;
    public string $password;
    public ?string $rememberToken;
    public string $created_at;
    public string $updated_at;
}