<?php

declare(strict_types=1);

namespace BombenProdukt\TypeId;

final class SuffixException extends AbstractTypeIdException
{
    public static function invalid(string $suffix): self
    {
        throw new self("Invalid suffix: {$suffix}");
    }

    public static function invalidFirstCharacter(string $suffix): self
    {
        throw new self("Invalid suffix: {$suffix}: First character must be in the range [0-7]");
    }
}
