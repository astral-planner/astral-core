<?php

declare(strict_types=1);

namespace App\Domain\User\Entity;

use App\Application\Common\Entity\EntityInterface;
use App\Application\Common\Entity\Trait\IdTrait;
use App\Application\Common\Entity\Trait\TimestampableTrait;
use App\Domain\User\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'users')]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity(fields: ['email'], message: 'This email is already used.')]
#[UniqueEntity(fields: ['username'], message: 'This username is already used.')]
class User implements EntityInterface, UserInterface, PasswordAuthenticatedUserInterface
{
    use IdTrait;
    use TimestampableTrait;

    #[Assert\NotBlank, Assert\Email]
    #[ORM\Column(type: Types::STRING, length: 255, unique: true)]
    private string $email;

    #[Assert\NotBlank, Assert\Length(min: 3, max: 255)]
    #[ORM\Column(type: Types::STRING, length: 255, unique: true)]
    private string $username;

    #[Assert\NotBlank, Assert\Length(min: 3, max: 255)]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $displayName;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $password;

    private ?string $plainPassword;

    private Role $role;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    public function setDisplayName(string $displayName): static
    {
        $this->displayName = $displayName;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): static
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function setRole(Role $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getRoles(): array
    {
        /* @phpstan-ignore-next-line */
        return [$this->role->getCode()];
    }

    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
    }

    public function getUserIdentifier(): string
    {
        return $this->getEmail();
    }
}
