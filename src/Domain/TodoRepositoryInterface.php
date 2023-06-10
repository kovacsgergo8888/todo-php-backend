<?php

namespace App\Domain;

use App\Domain\Shared\EntityId;

interface TodoRepositoryInterface
{
    public function add(Todo $todo): void;

    /**
     * @return Todo[]
     */
    public function getAllTodos(): array;

    public function removeTodo(EntityId $id): void;

    public function getTodo(EntityId $todoId): Todo;
}
