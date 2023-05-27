<?php

namespace App\Tests\Application;

use App\Application\RemoveTodoCommand;
use App\Application\RemoveTodoHandler;
use App\Domain\TodoRepositoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RemoveTodoHandlerTest extends TestCase
{
    private MockObject $todoRepository;
    private RemoveTodoHandler $handler;

    protected function setUp(): void
    {
        $this->todoRepository = $this->createMock(TodoRepositoryInterface::class);
        $this->handler = new RemoveTodoHandler($this->todoRepository);
    }

    public function testInvoke()
    {
        $command = new RemoveTodoCommand(123);
        $this->todoRepository->expects($this->once())
            ->method('removeTodo')
            ->with('123');

        $this->handler->__invoke($command);
    }
}
