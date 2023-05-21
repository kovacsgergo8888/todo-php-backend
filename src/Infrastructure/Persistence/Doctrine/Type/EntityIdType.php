<?php

namespace App\Infrastructure\Persistence\Doctrine\Type;

use App\Domain\Shared\EntityId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\BinaryType;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV4;

class EntityIdType extends BinaryType
{
    private const TYPE_NAME = 'entity_id';

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return null;
        }

        return new EntityId(UuidV4::fromBinary(stream_get_contents($value))->toRfc4122());
    }

    /**
     * @param EntityId $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return null;
        }

        return Uuid::fromRfc4122($value->value)->toBinary();
    }

    public function getName()
    {
        return self::TYPE_NAME;
    }

}