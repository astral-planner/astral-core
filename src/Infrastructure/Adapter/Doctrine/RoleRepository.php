<?php

declare(strict_types=1);

namespace Astral\Infrastructure\Adapter\Doctrine;

use Astral\Domain\Auth\Entity\Role;
use Astral\Domain\Auth\Port\RoleRepositoryInterface;
use Astral\Infrastructure\Orm\AbstractRepository;

class RoleRepository extends AbstractRepository implements RoleRepositoryInterface
{
    public function findOneOrNull(int $id): ?Role
    {
        return $this->find($id);
    }

    public function findOneFromRoleName(string $roleName): ?Role
    {
        return $this->findOneBy(['role' => $roleName]);
    }

    public function save(Role $role): void
    {
        $this->getEntityManager()->persist($role);
        $this->getEntityManager()->flush();
    }

    protected function getEntityClass(): string
    {
        return Role::class;
    }
}
