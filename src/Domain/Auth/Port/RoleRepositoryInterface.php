<?php

declare(strict_types=1);

namespace Astral\Domain\Auth\Port;

use Astral\Domain\Auth\Entity\Role;

interface RoleRepositoryInterface
{
    public function findOneOrNull(int $id): ?Role;
    public function findOneFromRoleName(string $roleName): ?Role;
    public function save(Role $role): void;
}
