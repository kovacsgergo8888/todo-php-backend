<?php

namespace App\Domain\Exception;

use Exception;

class TodoNotFoundException extends Exception
{
    protected $message = 'Todo not found';
    protected $code = 404;
}