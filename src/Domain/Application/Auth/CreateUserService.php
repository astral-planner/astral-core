<?php

declare(strict_types=1);

namespace App\Domain\Application\Auth;

use App\Domain\Auth\Entity\User;
use App\Domain\Auth\Port\UserRepositoryInterface;

class CreateUserService
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(User $user): User
    {
        $this->userRepository->save($user);

        return $user;
    }
}
