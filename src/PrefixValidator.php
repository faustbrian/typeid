<?php

declare(strict_types=1);

namespace BombenProdukt\TypeId;

final class PrefixValidator
{
    public static function validate(string $prefix): bool
    {
        if ($prefix === '') {
            return true;
        }

        if (\mb_strlen($prefix) > 63) {
            throw PrefixException::lengthMismatch($prefix);
        }

        if (!\preg_match('/^[a-z_]{0,63}$/', $prefix)) {
            throw PrefixException::invalid($prefix);
        }

        return true;
    }
}
