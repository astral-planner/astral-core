<?php

declare(strict_types=1);

namespace App\Domain\Application\Auth;

use App\Domain\Auth\Entity\Role;
use App\Domain\Auth\Port\RoleRepositoryInterface;

class CreateRoleService
{
    protected RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function createRole(Role $role): Role
    {
        $this->roleRepository->save($role);

        return $role;
    }
}
