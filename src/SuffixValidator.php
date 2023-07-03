<?php

declare(strict_types=1);

namespace BombenProdukt\TypeId;

use Exception;

final class SuffixValidator
{
    public static function validate(string $suffix): bool
    {
        if (\preg_match('/[A-Z]/', $suffix)) {
            throw SuffixException::invalid($suffix);
        }

        try {
            Base32::decode($suffix);

            return true;
        } catch (Exception) {
            throw SuffixException::invalid($suffix);
        }
    }
}
