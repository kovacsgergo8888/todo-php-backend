<?php

namespace App\Application;

class GetTodoQuery
{
    public function __construct(
        public readonly string $todoId
    ) {
    }
}
