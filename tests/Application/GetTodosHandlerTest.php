<?php

namespace App\Tests\Application;

use App\Application\GetTodosHandler;
use App\Application\GetTodosQuery;
use App\Domain\TodoRepositoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class GetTodosHandlerTest extends TestCase
{
    private MockObject $todoRepository;
    private GetTodosHandler $getTodosHandler;

    protected function setUp(): void
    {
        $this->todoRepository = $this->createMock(TodoRepositoryInterface::class);
        $this->getTodosHandler = new GetTodosHandler($this->todoRepository);
    }

    public function testHandle()
    {
        $query = new GetTodosQuery();
        $this->todoRepository->expects($this->once())
            ->method('getAllTodos')
            ->willReturn(['ALDI']);

        $this->assertEquals(['ALDI'], $this->getTodosHandler->__invoke($query));
    }
}
