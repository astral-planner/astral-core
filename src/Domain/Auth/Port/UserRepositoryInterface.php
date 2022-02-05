<?php

declare(strict_types=1);

namespace App\Domain\Auth\Port;

use App\Domain\Auth\Entity\User;

interface UserRepositoryInterface
{
    public function findOneOrNull(int $id): ?User;
    public function save(User $user): void;
}
