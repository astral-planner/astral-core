<?php

declare(strict_types=1);

namespace Astral\Application\Dto\Auth\Response;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class RoleResponseDto
{
    #[Assert\NotBlank]
    #[Serializer\Type("int")]
    public ?int $id;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Serializer\Type('string')]
    public string $name;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Serializer\Type('string')]
    public string $code;
}
