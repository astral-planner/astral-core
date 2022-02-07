<?php

declare(strict_types=1);

namespace Astral\Application\Auth;

use Astral\Domain\Auth\Entity\Role;
use Astral\Domain\Auth\Port\RoleRepositoryInterface;
use Astral\Infrastructure\Adapter\Doctrine\RoleRepository;

class FindRoleService
{
    private RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function findOneByRoleName(string $name): ?Role
    {
        return $this->roleRepository->findOneFromRoleName($name);
    }
}
