<?php

declare(strict_types=1);

namespace BombenProdukt\TypeId;

use Exception;
use TypeError;

final class SuffixValidator
{
    public static function validate(string $suffix): bool
    {
        if (\preg_match('/[A-Z]/', $suffix)) {
            throw new TypeError("Invalid suffix: {$suffix}");
        }

        try {
            Base32::decode($suffix);

            return true;
        } catch (Exception) {
            throw new TypeError("Invalid suffix: {$suffix}");
        }
    }
}
