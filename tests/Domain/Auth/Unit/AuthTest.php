<?php

declare(strict_types=1);

namespace App\Tests\Domain\Auth;

use App\Domain\Application\Auth\CreateRoleService;
use App\Domain\Application\Auth\CreateUserService;
use App\Domain\Auth\Entity\Role;
use App\Domain\Auth\Entity\User;
use App\Infrastructure\Adapter\RoleDoctrineRepository;

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

    expect($user->getRole()->getRole())->toBe(Role::ROLE_USER);
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

    $mockRoleRepository = mock(RoleDoctrineRepository::class)
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

    expect($mockCreateUserService->createUser($user))->toBeInstanceOf(User::class);
    expect($mockCreateUserService->createUser($user)->getRole())->toBeInstanceOf(Role::class);
});

it('should be able to register a user', function () {
    $userDb = null;

    expect($userDb)->toBeInstanceOf(User::class);
})->skip();
