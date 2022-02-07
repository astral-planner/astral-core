<?php

declare(strict_types=1);

namespace Astral\Application\Dto\Auth\Response\Transformer;

use Astral\Application\Dto\Auth\Response\UserResponseDto;
use Astral\Application\Dto\Exception\UnexpectedTypeException;
use Astral\Application\Dto\Transformer\AbstractResponseDtoTransformer;
use Astral\Domain\Auth\Model\User;

class UserResponseDtoTransformer extends AbstractResponseDtoTransformer
{
    public function __construct(
        private RoleResponseDtoTransformer $roleResponseDtoTransformer
    ) {
    }

    /**
     * @param User $user
     */
    public function transformFromObject($user): UserResponseDto
    {
        if (!$user instanceof User) {
            throw new UnexpectedTypeException('Expected type of User, got ' . get_class($user));
        }

        return new UserResponseDto(
            $user->getUsername(),
            $user->getPassword(),
            $user->getEmail(),
            $this->roleResponseDtoTransformer->transformFromObject($user->getRole()),
            $user->getAvatarUrl(),
            $user->getId()
        );
    }
}
