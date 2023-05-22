<?php

namespace App\Application;

readonly class RemoveTodoCommand
{

    public function __construct(public string $id)
    {
    }
}
