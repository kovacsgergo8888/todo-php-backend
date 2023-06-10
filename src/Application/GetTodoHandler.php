<?php

namespace App\Application;

use App\Domain\Shared\EntityId;
use App\Domain\Todo;
use App\Domain\TodoRepositoryInterface;

class GetTodoHandler
{
    public function __construct(
        private TodoRepositoryInterface $todoRepository
    ) {
    }

    public function __invoke(GetTodoQuery $query): Todo
    {
        return $this->todoRepository->getTodo(new EntityId($query->todoId));
    }
}
