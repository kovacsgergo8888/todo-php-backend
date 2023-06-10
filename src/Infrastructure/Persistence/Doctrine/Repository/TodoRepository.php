<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Shared\EntityId;
use App\Domain\Todo;
use App\Domain\TodoRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Domain\Exception\TodoNotFoundException;
use Doctrine\Persistence\ManagerRegistry;

class TodoRepository extends ServiceEntityRepository implements TodoRepositoryInterface
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Todo::class);
    }

    public function getTodo(EntityId $todoId): Todo { 
        return $this->find($todoId);
    }

    public function add(Todo $todo): void
    {
        $this->_em->persist($todo);
        $this->_em->flush();
    }

    public function getAllTodos(): array
    {
        return $this->findAll();
    }

    public function removeTodo(EntityId $id): void
    {
        $todo = $this->find($id);
        if ($todo === null) {
            throw new TodoNotFoundException();
        }
        $this->_em->remove($todo);
        $this->_em->flush();
    }
}