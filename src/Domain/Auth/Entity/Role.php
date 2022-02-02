<?php

declare(strict_types=1);

namespace App\Domain\Auth\Entity;

use App\Domain\Shared\Trait\NameableTrait;

class Role
{
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_USER = 'ROLE_USER';

    use NameableTrait;

    private int $id;

    private string $role = '';

    public function getId(): int
    {
        return $this->id;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }
}
