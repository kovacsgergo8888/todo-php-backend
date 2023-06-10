<?php

namespace App\Presentation\Rest;

use App\Application\AddTodoCommand;
use App\Application\GetTodoQuery;
use App\Application\GetTodosQuery;
use App\Application\RemoveTodoCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    #[Route(path: '/todo', name: 'add_todo', methods: ['POST'])]
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $command = new AddTodoCommand(
            $data['todo'],
            $data['dueDate'],
            $data['location']
        );
        $todo = $this->handle($command);
        return new JsonResponse($todo);
    }

    #[Route(path: '/todos', name: 'todos', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        $query = new GetTodosQuery();
        $todos = $this->handle($query);
        return new JsonResponse($todos);
    }

    #[Route(path: '/todo/{todoId}', name: 'remove_todo', methods: ['DELETE'])]
    public function remove(string $id): JsonResponse
    {
        $command = new RemoveTodoCommand($id);
        try {
            $this->handle($command);
        } catch (HandlerFailedException $exception) {
            $errors = array_map(
                fn ($currentException) => ['message' => $currentException->getMessage(), 'code' => $currentException->getCode()],
                $exception->getNestedExceptions()
            );
            return new JsonResponse(['errors' => $errors], 500);
        }
        return new JsonResponse(['message' => 'OK']);
    }

    #[Route(path: '/todo/{todoId}', name: 'get_todo', methods: ['GET'])]
    public function getTodo(string $todoId): JsonResponse
    {
        $query = new GetTodoQuery($todoId);
        $todo = $this->handle($query);

        return new JsonResponse($todo);
    }
}