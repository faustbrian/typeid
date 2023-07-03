<?php

declare(strict_types=1);

namespace BombenProdukt\TypeId;

use TypeError;

final class PrefixValidator
{
    public static function validate(string $prefix): bool
    {
        if ($prefix === '') {
            return true;
        }

        if (\mb_strlen($prefix) > 63) {
            throw new TypeError("Invalid prefix: {$prefix}. Prefix length is ".\mb_strlen($prefix).', expected <= 63');
        }

        if (!\preg_match('/^[a-z_]{0,63}$/', $prefix)) {
            throw new TypeError("Invalid prefix: {$prefix}. Prefix should match [a-z]{0,63}");
        }

        return true;
    }
}
