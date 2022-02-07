<?php

declare(strict_types=1);

namespace Astral\Application\Dto\Auth\Response;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class UserResponseDto
{
    #[Serializer\Type("int")]
    public ?int $id;

    #[Assert\NotBlank]
    #[Serializer\Type('string')]
    public string $username;

    #[Assert\NotBlank]
    #[Serializer\Type('string')]
    public string $password;

    #[Assert\NotBlank]
    #[Assert\Email(['html5'])]
    #[Serializer\Type('string')]
    public string $email;

    #[Assert\Type('string')]
    #[Serializer\Type('string')]
    public ?string $avatarUrl;

    #[Assert\NotBlank]
    #[Serializer\Type(RoleResponseDto::class)]
    public RoleResponseDto $role;

    public function __construct(
        string $username,
        string $password,
        string $email,
        RoleResponseDto $role,
        ?string $avatarUrl,
        ?int $id,
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->role = $role;
        $this->avatarUrl = $avatarUrl;
        $this->id = $id;
    }
}
