<?php

namespace App\Domain;

interface TodoRepositoryInterface
{
    public function add(Todo $todo): void;

    /**
     * @return Todo[]
     */
    public function getAllTodos(): array;

    public function removeTodo($id): void;
}