<?php

declare(strict_types=1);

namespace App\Infrastructure\Adapter;

use App\Domain\Auth\Entity\Role;
use App\Domain\Auth\Port\RoleRepositoryInterface;
use App\Infrastructure\Orm\AbstractRepository;

class RoleDoctrineRepository extends AbstractRepository implements RoleRepositoryInterface
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
