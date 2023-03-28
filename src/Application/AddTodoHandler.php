<?php

namespace App\Application;

use App\Domain\Todo;
use App\Domain\TodoRepositoryInterface;
use DateTime;

readonly class AddTodoHandler
{


    public function __construct(private TodoRepositoryInterface $todoRepository)
    {
    }

    public function __invoke(AddTodoCommand $command): void
    {
        $todo = new Todo(
            $command->todo,
            new DateTime($command->dueDate),
            $command->location,
        );
        $this->todoRepository->add($todo);
    }
}