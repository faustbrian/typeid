<?php

declare(strict_types=1);

namespace Tests\Unit;

use BombenProdukt\TypeId\Decoder;

it('decodes with a prefix and uuid', function (string $name, string $typeid, string $prefix, string $uuid): void {
    $decoder = new Decoder();
    $decoded = $decoder->decode($typeid);

    expect($decoded->getType())->toBe($prefix);
    expect($decoded->getUuid())->toBe($uuid);
})->with('valid');
