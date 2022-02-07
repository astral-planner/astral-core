<?php

declare(strict_types=1);

namespace Astral\Domain\Auth\Port;

use Astral\Domain\Auth\Model\Role;

interface RoleRepositoryInterface
{
    public function findOneOrNull(int $id): ?Role;

    public function findOneFromCodeName(string $roleName): ?Role;

    public function save(Role $role): void;
}
