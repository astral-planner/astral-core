<?php

declare(strict_types=1);

namespace Astral\Infrastructure\Adapter\Doctrine;

use Astral\Domain\Auth\Model\Role;
use Astral\Domain\Auth\Port\RoleRepositoryInterface;
use Astral\Infrastructure\Orm\AbstractRepository;

class RoleRepository extends AbstractRepository implements RoleRepositoryInterface
{
    public function findOneOrNull(int $id): ?Role
    {
        return $this->find($id);
    }

    public function findOneFromCodeName(string $roleName): ?Role
    {
        return $this->findOneBy(['code' => $roleName]);
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
