<?php

namespace App\Domain\Shared;

use JsonSerializable;

class EntityId implements JsonSerializable
{
    public function __construct(
        public string $value
    ) {
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function jsonSerialize(): mixed
    {
        return $this->value;
    }
}