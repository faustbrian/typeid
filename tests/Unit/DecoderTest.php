<?php

declare(strict_types=1);

namespace Tests\Unit;

use BombenProdukt\TypeId\AbstractTypeIdException;
use BombenProdukt\TypeId\Decoder;

it('decodes with a prefix and uuid', function (string $name, string $typeid, string $prefix, string $uuid): void {
    $decoder = new Decoder();
    $decoded = $decoder->decode($typeid);

    expect($decoded->getType())->toBe($prefix);
    expect($decoded->getUuid())->toBe($uuid);
})->with('valid');

it('fails to decode invalid values', function (string $name, string $typeid, string $description): void {
    expect(fn () => (new Decoder())->decode($typeid))->toThrow(AbstractTypeIdException::class);
})->with('invalid');
