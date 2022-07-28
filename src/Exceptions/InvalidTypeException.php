<?php

declare(strict_types=1);

namespace Xttribute\Xttribute\Exceptions;

use Exception;

class InvalidTypeException extends Exception
{
    public function __construct(
        string $message,
        public readonly string $type,
        public readonly string $foundValue,
    ) {
        parent::__construct($message);
    }
}
