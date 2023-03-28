<?php

namespace App\Application;

use App\Domain\TodoRepositoryInterface;

readonly class GetTodosHandler
{
    public function __construct(private TodoRepositoryInterface $todoRepository)
    {}

    public function __invoke(GetTodosQuery $query): array
    {
        return $this->todoRepository->getAllTodos();
    }
}