<?php

declare(strict_types=1);

namespace Astral\Application\Dto\Auth\Response\Transformer;

use Astral\Application\Dto\Auth\Response\RoleResponseDto;
use Astral\Application\Dto\Exception\UnexpectedTypeException;
use Astral\Application\Dto\Transformer\AbstractResponseDtoTransformer;
use Astral\Domain\Auth\Model\Role;

class RoleResponseDtoTransformer extends AbstractResponseDtoTransformer
{
    /**
     * @param Role $role
     */
    public function transformFromObject($role): RoleResponseDto
    {
        if (!$role instanceof Role) {
            throw new UnexpectedTypeException('Expected type of User, got ' . get_class($role));
        }

        return new RoleResponseDto(
            $role->getId(),
            $role->getName(),
            $role->getCode(),
        );
    }
}
