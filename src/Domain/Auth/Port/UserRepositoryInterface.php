<?php

declare(strict_types=1);

namespace Astral\Domain\Auth\Port;

use Astral\Domain\Auth\Entity\User;

interface UserRepositoryInterface
{
    public function findOneOrNull(int $id): ?User;
    public function save(User $user): void;
}
