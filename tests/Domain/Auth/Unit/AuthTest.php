<?php

declare(strict_types=1);

namespace Astral\Tests\Domain\Unit\Auth;

use Astral\Application\Auth\CreateRoleService;
use Astral\Application\Auth\CreateUserService;
use Astral\Domain\Auth\Model\Role;
use Astral\Domain\Auth\Model\User;
use Astral\Infrastructure\Adapter\Doctrine\RoleRepository;

it('should be able to create a user', function () {
    $role = new Role(
        'User',
        Role::ROLE_USER
    );

    $user = new User(
        'test',
        'pwd',
        'pwd',
        'test@test.io',
        $role
    );

    expect($user)->toBeInstanceOf(User::class);
});

test('a user should have an user role as default', function () {
    $role = new Role(
        'User',
        Role::ROLE_USER
    );

    $user = new User(
        'test',
        'pwd',
        'pwd',
        'test@test.io',
        $role
    );

    expect($user->getRole()->getCode())->toBe(Role::ROLE_USER);
});

it('should be able to save a user in the database', function () {
    $mockCreateRoleService = mock(CreateRoleService::class)
        ->expect(
            createRole: fn ($roleName) => new Role(
                'User',
                Role::ROLE_USER
            )
        )
    ;

    $mockRoleRepository = mock(RoleRepository::class)
        ->expect(
            findOneFromRoleName: fn ($roleName) => null
        )
    ;

    $role = $mockRoleRepository->findOneFromRoleName(Role::ROLE_USER);

    if (null === $role) {
        $role = new Role(
            'User',
            Role::ROLE_USER
        );

        $role = $mockCreateRoleService->createRole($role);
    }

    $user = new User(
        'test',
        'pwd',
        'pwd',
        'test@test.io',
        $role
    );

    $mockCreateUserService = mock(CreateUserService::class)
        ->expect(
            createUser: fn ($user) => $user
        )
    ;

    $userDb = $mockCreateUserService->createUser($user);

    expect($userDb)->toBeInstanceOf(User::class);
    expect($userDb->getRole())->toBeInstanceOf(Role::class);
});
