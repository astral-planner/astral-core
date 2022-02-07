<?php

declare(strict_types=1);

namespace Astral\Application\Auth;

use Astral\Domain\Auth\Model\User;
use Astral\Domain\Auth\Port\UserRepositoryInterface;
use Astral\Infrastructure\Adapter\Doctrine\UserRepository;

class CreateUserService
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(User $user): User
    {
        $this->userRepository->save($user);

        return $user;
    }
}
