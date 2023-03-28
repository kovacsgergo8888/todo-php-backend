<?php

namespace App\Domain;

use DateTime;

class Todo
{
    public function __construct(
        public string $todo,
        public DateTime $dueDate,
        public string $location,
        public ?int $id = null,
    ) {
    }
}