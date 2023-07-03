<?php

declare(strict_types=1);

namespace BombenProdukt\TypeId;

final class TypeIdException extends AbstractTypeIdException
{
    public static function empty(string $id): self
    {
        throw new self("Invalid TypeID. Prefix cannot be empty when there's a separator: {$id}");
    }
}
