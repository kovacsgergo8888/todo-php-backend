<?php

namespace App\Tests\Application;

use App\Application\GetTodoHandler;
use App\Application\GetTodoQuery;
use App\Domain\Todo;
use App\Domain\TodoRepositoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class GetTodoHandlerTest extends TestCase
{
    private MockObject $todoRepository;
    private GetTodoHandler $handler;

    protected function setUp(): void
    {
        $this->todoRepository = $this->createMock(TodoRepositoryInterface::class);
        $this->handler = new GetTodoHandler($this->todoRepository);
    }

    public function testInvoke(): void
    {
        $todo = $this->createMock(Todo::class);
        $query = new GetTodoQuery('asd');
        $this->todoRepository->expects($this->once())
            ->method('getTodo')
            ->willReturn($todo);

        $this->assertEquals($todo, $this->handler->__invoke($query));
    }
}
