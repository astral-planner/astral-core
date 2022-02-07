<?php

declare(strict_types=1);

namespace Astral\Domain\Auth\Entity;

use Astral\Domain\Shared\Trait\IdentifyableTrait;
use Astral\Domain\Shared\Trait\TimestampableTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
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
    private ?string $avatarPath = null;

    #[ORM\Column(type: Types::INTEGER)]
    private int $status = self::STATUS_INACTIVE;

    #[ORM\ManyToOne(targetEntity: Role::class, inversedBy: "users")]
    private Role $role;

    public function __construct(
        string $username,
        string $password,
        string $plainPassword,
        string $email,
        ?Role $role,
        ?string $avatarPath = null,
        ?int $status = self::STATUS_INACTIVE
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->plainPassword = $plainPassword;
        $this->email = $email;
        $this->role = $role;
        $this->avatarPath = $avatarPath;
        $this->status = $status;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

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

    public function getRole(): Role
    {
        return $this->role;
    }

    public function setRole(Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getRoles(): array
    {
        return [$this->getRole()->getRole()];
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }
}
