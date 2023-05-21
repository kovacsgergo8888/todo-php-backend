<?php

namespace App\Infrastructure\Persistence\Doctrine\Type;

use App\Domain\Shared\EntityId;
use App\Domain\Shared\EntityIdGeneratorInterface;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV4;

class EntityIdGenerator implements EntityIdGeneratorInterface
{

    public function generateEntityId(): EntityId
    {
        return new EntityId(
            Uuid::v4()->toRfc4122()
        );
    }
}