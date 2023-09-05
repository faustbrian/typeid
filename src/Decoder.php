<?php

declare(strict_types=1);

namespace BombenProdukt\TypeId;

use Ramsey\Uuid\Uuid;

final class Decoder
{
    public static function decode(string $id): Decoded
    {
        if (\str_contains($id, '_')) {
            [$type, $uuid] = \explode('_', $id, 2);

            if ($type === '') {
                throw TypeIdException::empty($id);
            }
        } else {
            $type = '';
            $uuid = $id;
        }

        if (!PrefixValidator::validate($type)) {
            throw PrefixException::invalid($type);
        }

        if (!SuffixValidator::validate($uuid)) {
            throw SuffixException::invalid($uuid);
        }

        return new Decoded(
            $type,
            Uuid::fromString(
                \implode('', \array_map(fn ($b) => \str_pad(\dechex($b), 2, '0', \STR_PAD_LEFT), Base32::decode($uuid))),
            )->toString(),
        );
    }
}
