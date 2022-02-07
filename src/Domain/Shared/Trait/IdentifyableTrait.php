<?php

declare(strict_types=1);

namespace Astral\Domain\Shared\Trait;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait IdentifyableTrait
{
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\Id, ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
