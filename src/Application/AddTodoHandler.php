<?php

namespace App\Application;

use App\Domain\Shared\EntityIdGeneratorInterface;
use App\Domain\Todo;
use App\Domain\TodoRepositoryInterface;
use DateTime;

readonly class AddTodoHandler
{
    public function __construct(
        private TodoRepositoryInterface $todoRepository,
        private EntityIdGeneratorInterface $entityIdGenerator,
    ) {
    }

    public function __invoke(AddTodoCommand $command): Todo
    {
        $todo = new Todo(
            $this->entityIdGenerator->generateEntityId(),
            $command->todo,
            new DateTime($command->dueDate),
            $command->location,
        );
        $this->todoRepository->add($todo);

        return $todo;
    }
}