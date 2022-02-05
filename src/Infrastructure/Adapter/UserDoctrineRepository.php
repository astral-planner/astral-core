<?php

declare(strict_types=1);

namespace App\Infrastructure\Adapter;

use App\Domain\Auth\Entity\User;
use App\Domain\Auth\Port\UserRepositoryInterface;
use App\Infrastructure\Orm\AbstractRepository;

class UserDoctrineRepository extends AbstractRepository implements UserRepositoryInterface
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
