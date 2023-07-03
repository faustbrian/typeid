<?php

declare(strict_types=1);

namespace BombenProdukt\TypeId;

final class Decoded
{
    public function __construct(
        private string $type,
        private string $uuid,
    ) {}

    public function getType(): string
    {
        return $this->type;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
