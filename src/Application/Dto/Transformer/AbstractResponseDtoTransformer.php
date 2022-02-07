<?php

declare(strict_types=1);

namespace Astral\Application\Dto\Transformer;

abstract class AbstractResponseDtoTransformer implements ResponseDtoTransformerInterface
{
    public function transformFromObjects(iterable $object): iterable
    {
        $dto = [];

        foreach ($object as $item) {
            $dto[] = $this->transformFromObject($item);
        }

        return $dto;
    }
}
