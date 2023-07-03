<?php

declare(strict_types=1);

namespace BombenProdukt\TypeId;

final class Base32
{
    private const ALPHABET = '0123456789abcdefghjkmnpqrstvwxyz';

    private const DECIMAL_TABLE = [
        0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF,
        0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF,
        0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF,
        0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF,
        0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0x00, 0x01,
        0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0xFF, 0xFF,
        0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0x0A, 0x0B, 0x0C, 0x0D, 0x0E,
        0x0F, 0x10, 0x11, 0xFF, 0x12, 0x13, 0xFF, 0x14, 0x15, 0xFF,
        0x16, 0x17, 0x18, 0x19, 0x1A, 0xFF, 0x1B, 0x1C, 0x1D, 0x1E,
        0x1F, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0x0A, 0x0B, 0x0C,
        0x0D, 0x0E, 0x0F, 0x10, 0x11, 0xFF, 0x12, 0x13, 0xFF, 0x14,
        0x15, 0xFF, 0x16, 0x17, 0x18, 0x19, 0x1A, 0xFF, 0x1B, 0x1C,
        0x1D, 0x1E, 0x1F, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF,
        0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF,
        0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF,
        0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF,
        0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF,
        0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF,
        0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF,
        0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF,
        0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF,
        0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF,
        0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF,
        0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF,
        0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF,
        0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF,
    ];

    public static function encode(array $src): string
    {
        // Initialize the result array
        $dst = \array_fill(0, 26, '');

        if (\count($src) !== 16) {
            throw new TypeIdException('Invalid length');
        }

        // 10 byte timestamp
        $dst[0] = self::ALPHABET[($src[0] & 224) >> 5];
        $dst[1] = self::ALPHABET[$src[0] & 31];
        $dst[2] = self::ALPHABET[($src[1] & 248) >> 3];
        $dst[3] = self::ALPHABET[(($src[1] & 7) << 2) | (($src[2] & 192) >> 6)];
        $dst[4] = self::ALPHABET[($src[2] & 62) >> 1];
        $dst[5] = self::ALPHABET[(($src[2] & 1) << 4) | (($src[3] & 240) >> 4)];
        $dst[6] = self::ALPHABET[(($src[3] & 15) << 1) | (($src[4] & 128) >> 7)];
        $dst[7] = self::ALPHABET[($src[4] & 124) >> 2];
        $dst[8] = self::ALPHABET[(($src[4] & 3) << 3) | (($src[5] & 224) >> 5)];
        $dst[9] = self::ALPHABET[$src[5] & 31];

        // 16 bytes of randomness
        $dst[10] = self::ALPHABET[($src[6] & 248) >> 3];
        $dst[11] = self::ALPHABET[(($src[6] & 7) << 2) | (($src[7] & 192) >> 6)];
        $dst[12] = self::ALPHABET[($src[7] & 62) >> 1];
        $dst[13] = self::ALPHABET[(($src[7] & 1) << 4) | (($src[8] & 240) >> 4)];
        $dst[14] = self::ALPHABET[(($src[8] & 15) << 1) | (($src[9] & 128) >> 7)];
        $dst[15] = self::ALPHABET[($src[9] & 124) >> 2];
        $dst[16] = self::ALPHABET[(($src[9] & 3) << 3) | (($src[10] & 224) >> 5)];
        $dst[17] = self::ALPHABET[$src[10] & 31];
        $dst[18] = self::ALPHABET[($src[11] & 248) >> 3];
        $dst[19] = self::ALPHABET[(($src[11] & 7) << 2) | (($src[12] & 192) >> 6)];
        $dst[20] = self::ALPHABET[($src[12] & 62) >> 1];
        $dst[21] = self::ALPHABET[(($src[12] & 1) << 4) | (($src[13] & 240) >> 4)];
        $dst[22] = self::ALPHABET[(($src[13] & 15) << 1) | (($src[14] & 128) >> 7)];
        $dst[23] = self::ALPHABET[($src[14] & 124) >> 2];
        $dst[24] = self::ALPHABET[(($src[14] & 3) << 3) | (($src[15] & 224) >> 5)];
        $dst[25] = self::ALPHABET[$src[15] & 31];

        return \implode('', $dst);
    }

    public static function decode(string $s): array
    {
        if (\mb_strlen($s) !== 26) {
            throw new TypeIdException('Invalid length');
        }
        // Convert string to an array of ASCII values
        $v = \array_map('ord', \mb_str_split($s));

        // Check if all the characters are part of the expected character set.
        foreach ($v as $value) {
            if (self::DECIMAL_TABLE[$value] === 0xFF) {
                throw new TypeIdException('Invalid base32 character');
            }
        }

        $id = \array_fill(0, 16, 0);

        // 6 bytes timestamp (48 bits)
        $id[0] = (self::DECIMAL_TABLE[$v[0]] << 5) | self::DECIMAL_TABLE[$v[1]];
        $id[1] = (self::DECIMAL_TABLE[$v[2]] << 3) | (self::DECIMAL_TABLE[$v[3]] >> 2);
        $id[2] = ((self::DECIMAL_TABLE[$v[3]] & 3) << 6) | (self::DECIMAL_TABLE[$v[4]] << 1) | (self::DECIMAL_TABLE[$v[5]] >> 4);
        $id[3] = ((self::DECIMAL_TABLE[$v[5]] & 15) << 4) | (self::DECIMAL_TABLE[$v[6]] >> 1);
        $id[4] = ((self::DECIMAL_TABLE[$v[6]] & 1) << 7) | (self::DECIMAL_TABLE[$v[7]] << 2) | (self::DECIMAL_TABLE[$v[8]] >> 3);
        $id[5] = ((self::DECIMAL_TABLE[$v[8]] & 7) << 5) | self::DECIMAL_TABLE[$v[9]];

        // 10 bytes of entropy (80 bits)
        $id[6] = (self::DECIMAL_TABLE[$v[10]] << 3) | (self::DECIMAL_TABLE[$v[11]] >> 2);
        $id[7] = ((self::DECIMAL_TABLE[$v[11]] & 3) << 6) | (self::DECIMAL_TABLE[$v[12]] << 1) | (self::DECIMAL_TABLE[$v[13]] >> 4);
        $id[8] = ((self::DECIMAL_TABLE[$v[13]] & 15) << 4) | (self::DECIMAL_TABLE[$v[14]] >> 1);
        $id[9] = ((self::DECIMAL_TABLE[$v[14]] & 1) << 7) | (self::DECIMAL_TABLE[$v[15]] << 2) | (self::DECIMAL_TABLE[$v[16]] >> 3);
        $id[10] = ((self::DECIMAL_TABLE[$v[16]] & 7) << 5) | self::DECIMAL_TABLE[$v[17]];
        $id[11] = (self::DECIMAL_TABLE[$v[18]] << 3) | (self::DECIMAL_TABLE[$v[19]] >> 2);
        $id[12] = ((self::DECIMAL_TABLE[$v[19]] & 3) << 6) | (self::DECIMAL_TABLE[$v[20]] << 1) | (self::DECIMAL_TABLE[$v[21]] >> 4);
        $id[13] = ((self::DECIMAL_TABLE[$v[21]] & 15) << 4) | (self::DECIMAL_TABLE[$v[22]] >> 1);
        $id[14] = ((self::DECIMAL_TABLE[$v[22]] & 1) << 7) | (self::DECIMAL_TABLE[$v[23]] << 2) | (self::DECIMAL_TABLE[$v[24]] >> 3);
        $id[15] = ((self::DECIMAL_TABLE[$v[24]] & 7) << 5) | self::DECIMAL_TABLE[$v[25]];

        return $id;
    }
}
