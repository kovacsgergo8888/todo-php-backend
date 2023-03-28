<?php

namespace App\Application;

use DateTime;

readonly class AddTodoCommand
{
    public function __construct(
        public string $todo,
        public string $dueDate,
        public string $location,
    ) {
    }
}