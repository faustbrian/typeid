<?php

declare(strict_types=1);

namespace BombenProdukt\TypeId;

use Ramsey\Uuid\Uuid;
use TypeError;

final readonly class Decoder
{
    public static function decode(string $id): Decoded
    {
        if (\str_contains($id, '_')) {
            [$type, $uuid] = \explode('_', $id, 2);
        } else {
            $type = '';
            $uuid = $id;
        }

        if (!PrefixValidator::validate($type)) {
            throw new TypeError("Invalid prefix: '{$type}'. Prefix should match [a-z]+");
        }

        if (!SuffixValidator::validate($uuid)) {
            throw new TypeError('Invalid suffix');
        }

        return new Decoded(
            $type,
            Uuid::fromString(
                \implode('', \array_map(fn ($b) => \str_pad(\dechex($b), 2, '0', \STR_PAD_LEFT), Base32::decode($uuid))),
            )->toString(),
        );
    }
}
