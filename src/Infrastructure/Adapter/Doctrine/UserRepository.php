<?php

declare(strict_types=1);

namespace Astral\Infrastructure\Adapter\Doctrine;

use Astral\Domain\Auth\Model\User;
use Astral\Domain\Auth\Port\UserRepositoryInterface;
use Astral\Infrastructure\Orm\AbstractRepository;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    public function findOneOrNull(int $id): ?User
    {
        return $this->find($id);
    }

    public function save(User $user): void
    {
        if (!$user->getId()) {
            $this->getEntityManager()->persist($user);
        }

        $this->getEntityManager()->flush();
    }

    protected function getEntityClass(): string
    {
        return User::class;
    }
}
