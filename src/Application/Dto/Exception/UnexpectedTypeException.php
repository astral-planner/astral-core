<?php

declare(strict_types=1);

namespace Astral\Application\Dto\Exception;

use JetBrains\PhpStorm\Pure;

class UnexpectedTypeException extends \RuntimeException
{
    public const CODE = 113;

    public function __construct(
        string $message = "",
        int $code = self::CODE,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
