<?php

declare(strict_types=1);

namespace BombenProdukt\TypeId;

final class PrefixException extends AbstractTypeIdException
{
    public static function invalid(string $prefix): self
    {
        throw new self("Invalid prefix: {$prefix}. Prefix should match [a-z]+");
    }

    public static function lengthMismatch(string $prefix): self
    {
        throw new self("Invalid prefix: {$prefix}. Prefix length is ".\mb_strlen($prefix).', expected <= 63');
    }
}
