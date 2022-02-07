<?php

declare(strict_types=1);

namespace Astral\Application\Dto\Transformer;

interface ResponseDtoTransformerInterface
{
    public function transformFromObject($object);

    public function transformFromObjects(iterable $object): iterable;
}
