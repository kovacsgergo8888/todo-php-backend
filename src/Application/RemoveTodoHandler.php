<?php

namespace App\Application;

use App\Domain\TodoRepositoryInterface;

class RemoveTodoHandler
{
    public function __construct(private TodoRepositoryInterface $todoRepository)
    {}

    public function __invoke(RemoveTodoCommand $command): void
    {
        $this->todoRepository->removeTodo($command->id);
    }
}