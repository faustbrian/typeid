<?php

declare(strict_types=1);

namespace BombenProdukt\TypeId;

use JsonSerializable;
use Stringable;

final class TypeId implements JsonSerializable, Stringable
{
    public function __construct(
        private string $prefix,
        private string $suffix,
    ) {}

    public function __toString(): string
    {
        if ($this->prefix === '') {
            return $this->suffix;
        }

        return $this->prefix.'_'.$this->suffix;
    }

    public static function fromPrefix(string $prefix): self
    {
        if (PrefixValidator::validate($prefix)) {
            return new self($prefix, Uuid::random()->toBase32());
        }

        throw PrefixException::invalid($prefix);
    }

    public static function fromUuid(string $prefix, string $suffix): self
    {
        if (PrefixValidator::validate($prefix)) {
            return new self($prefix, Uuid::fromString($suffix)->toBase32());
        }

        throw PrefixException::invalid($prefix);
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    public function getSuffix(): string
    {
        return $this->suffix;
    }

    public function toString(): string
    {
        return $this->__toString();
    }

    public function jsonSerialize(): string
    {
        return $this->__toString();
    }
}
