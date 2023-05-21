<?php

namespace App\Application;

use App\Domain\TodoRepositoryInterface;
use App\Domain\Shared\EntityId;

class RemoveTodoHandler
{
    public function __construct(private TodoRepositoryInterface $todoRepository)
    {}

    public function __invoke(RemoveTodoCommand $command): void
    {
        $this->todoRepository->removeTodo(new EntityId($command->id));
    }
}