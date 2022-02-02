<?php

declare(strict_types=1);

namespace App\Domain\Auth\Entity;

use App\Domain\Shared\Trait\IdentifyableTrait;
use App\Domain\Shared\Trait\TimestampableTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_BANNED = 2;

    use IdentifyableTrait;
    use TimestampableTrait;

    #[ORM\Column(type: Types::STRING, length: 255, unique: true)]
    private string $username = '';

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $plainPassword = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $password = '';

    #[Assert\Email(mode: Assert\Email::VALIDATION_MODE_HTML5)]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $email = '';

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $role = Role::ROLE_USER;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $avatarPath = null;

    #[ORM\Column(type: Types::INTEGER)]
    private int $status = self::STATUS_INACTIVE;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAvatarPath(): ?string
    {
        return $this->avatarPath;
    }

    public function setAvatarPath(?string $avatarPath): self
    {
        $this->avatarPath = $avatarPath;

        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
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

    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getPassword(): string
    {
        // TODO: Implement getPassword() method.
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }
}
