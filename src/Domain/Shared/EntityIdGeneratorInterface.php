<?php

namespace App\Domain\Shared;

interface EntityIdGeneratorInterface
{
    public function generateEntityId(): EntityId;
}