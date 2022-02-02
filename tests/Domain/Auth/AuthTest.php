<?php

declare(strict_types=1);

namespace App\Tests\Domain\Auth;

use App\Domain\Auth\Entity\Role;
use App\Domain\Auth\Entity\User;

it('should be able to create a user', function () {
    $user = new User();

    expect($user)->toBeInstanceOf(User::class);
});

test('a user should have an user role as default', function () {
    $user = new User();

    expect($user->getRole())->toBe(Role::ROLE_USER);
});

it('should be able to register a user', function () {
    $userDb = null;

    expect($userDb)->toBeInstanceOf(User::class);
});
