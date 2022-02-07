<?php

declare(strict_types=1);

namespace Astral\Domain\Auth\Model;

use Astral\Domain\Shared\Trait\IdentifyableTrait;
use Astral\Domain\Shared\Trait\NameableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Role
{
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_USER = 'ROLE_USER';

    use IdentifyableTrait;
    use NameableTrait;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $code;

    #[ORM\OneToMany(mappedBy: 'code', targetEntity: User::class)]
    private Collection $users;

    public function __construct(
        string $name,
        string $code
    ) {
        $this->name = $name;
        $this->code = $code;
        $this->users = new ArrayCollection();
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getUsers(): Collection
    {
        return $this->users;
    }
}
