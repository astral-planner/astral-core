<?php

declare(strict_types=1);

namespace App\Domain\Auth\Entity;

use App\Domain\Shared\Trait\IdentifyableTrait;
use App\Domain\Shared\Trait\NameableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Role
{
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_USER = 'ROLE_USER';

    use IdentifyableTrait;
    use NameableTrait;

    #[Assert\NotBlank]
    #[Assert\Type(type: Types::STRING)]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $role;

    #[ORM\OneToMany(mappedBy: 'role', targetEntity: User::class)]
    private Collection $users;

    public function __construct(
        string $name,
        string $role
    ) {
        $this->name = $name;
        $this->role = $role;
        $this->users = new ArrayCollection();
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getUsers(): Collection
    {
        return $this->users;
    }
}
