<?php

declare(strict_types=1);

namespace Astral\Application\Auth;

use Astral\Domain\Auth\Model\Role;
use Astral\Domain\Auth\Port\RoleRepositoryInterface;
use Astral\Infrastructure\Adapter\Doctrine\RoleRepository;

class CreateRoleService
{
    protected RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function createRole(Role $role): Role
    {
        $this->roleRepository->save($role);

        return $role;
    }
}
