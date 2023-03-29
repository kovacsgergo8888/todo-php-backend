<?php

namespace App\Tests\Application;

use App\Application\AddTodoCommand;
use App\Application\AddTodoHandler;
use App\Domain\TodoRepositoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AddTodoHandlerTest extends TestCase
{
    private MockObject $todoRepository;
    private AddTodoHandler $handler;
    protected function setUp(): void
    {
        $this->todoRepository = $this->createMock(TodoRepositoryInterface::class);
        $this->handler = new AddTodoHandler($this->todoRepository);
    }

    public function testHandle()
    {
        $todo = new AddTodoCommand('some todo', '2022-12-12', 'ALDI');
        $this->todoRepository->expects($this->once())
            ->method('add');
        $this->handler->__invoke($todo);
    }

}
