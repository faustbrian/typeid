<?php

declare(strict_types=1);

namespace BombenProdukt\TypeId;

final class SuffixException extends AbstractTypeIdException
{
    public static function invalid(string $suffix): self
    {
        throw new self("Invalid suffix: {$suffix}");
    }
}
