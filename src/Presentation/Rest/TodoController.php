<?php

namespace App\Presentation\Rest;

use App\Application\AddTodoCommand;
use App\Application\GetTodosQuery;
use App\Application\RemoveTodoCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class TodoController extends AbstractController
{
    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

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

    public function getAll(): JsonResponse
    {
        $query = new GetTodosQuery();
        $todos = $this->handle($query);
        return new JsonResponse($todos);
    }

    public function remove(string $id): JsonResponse
    {
        $command = new RemoveTodoCommand($id);
        $this->handle($command);
        return new JsonResponse(['message' => 'OK']);
    }
}