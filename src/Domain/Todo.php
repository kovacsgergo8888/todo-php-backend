<?php

namespace App\Domain;

use App\Domain\Shared\EntityId;
use DateTime;

class Todo
{
    public function __construct(
        public EntityId $id,
        public string $todo,
        public DateTime $dueDate,
        public string $location
    ) {
    }
}