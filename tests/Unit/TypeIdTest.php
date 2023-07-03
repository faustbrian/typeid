<?php

declare(strict_types=1);

namespace Tests\Unit;

use BombenProdukt\TypeId\TypeId;
use BombenProdukt\TypeId\Uuid;

it('creates a TypeId instance', function (string $name, string $typeid, string $prefix, string $uuid): void {
    $encoded = TypeId::fromUuid($prefix, $uuid);

    expect($encoded->getPrefix())->toBe($prefix);
    expect($encoded->getSuffix())->toBe(Uuid::fromString($uuid)->toBase32());
})->with('valid');
