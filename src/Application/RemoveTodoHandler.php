<?php

namespace App\Application;

use App\Application\Exception\ApplicationException;
use App\Domain\Exception\TodoNotFoundException;
use App\Domain\TodoRepositoryInterface;
use App\Domain\Shared\EntityId;

class RemoveTodoHandler
{
    public function __construct(private TodoRepositoryInterface $todoRepository)
    {}

    public function __invoke(RemoveTodoCommand $command): void
    {
        try {
            $this->todoRepository->removeTodo(new EntityId($command->id));
        } catch (TodoNotFoundException $exception) {
            throw new ApplicationException($exception->getMessage(), $exception->getCode());
        }
    }
}