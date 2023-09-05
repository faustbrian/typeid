<?php

declare(strict_types=1);

namespace BombenProdukt\TypeId;

use Ramsey\Uuid\Uuid as Ramsey;
use Ramsey\Uuid\UuidInterface;

final class Uuid
{
    public function __construct(private string $uuid) {}

    public function __toString(): string
    {
        return $this->uuid;
    }

    public static function fromString(string $uuid): self
    {
        return new self($uuid);
    }

    public static function fromRamsey(UuidInterface $uuid): self
    {
        return new self($uuid->toString());
    }

    public static function random(): self
    {
        return new self(Ramsey::uuid7()->toString());
    }

    public function toBase32(): string
    {
        // Convert UUID string to an array of hexadecimal blocks
        $blocks = [
            \mb_substr($this->uuid, 0, 8),
            \mb_substr($this->uuid, 9, 4),
            \mb_substr($this->uuid, 14, 4),
            \mb_substr($this->uuid, 19, 4),
            \mb_substr($this->uuid, 24),
        ];

        // Initialize the result array
        $arr = \array_fill(0, 16, 0);

        // Block 1
        $v = \hexdec($blocks[0]);
        $arr[0] = $v >> 24;
        $arr[1] = ($v >> 16) & 0xFF;
        $arr[2] = ($v >> 8) & 0xFF;
        $arr[3] = $v & 0xFF;

        // Block 2
        $v = \hexdec($blocks[1]);
        $arr[4] = $v >> 8;
        $arr[5] = $v & 0xFF;

        // Block 3
        $v = \hexdec($blocks[2]);
        $arr[6] = $v >> 8;
        $arr[7] = $v & 0xFF;

        // Block 4
        $v = \hexdec($blocks[3]);
        $arr[8] = $v >> 8;
        $arr[9] = $v & 0xFF;

        // Block 5
        $v = \hexdec($blocks[4]);
        $arr[10] = ($v / 0x10000000000) & 0xFF;
        $arr[11] = ($v / 0x100000000) & 0xFF;
        $arr[12] = ($v >> 24) & 0xFF;
        $arr[13] = ($v >> 16) & 0xFF;
        $arr[14] = ($v >> 8) & 0xFF;
        $arr[15] = $v & 0xFF;

        return Base32::encode($arr);
    }
}
