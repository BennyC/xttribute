<?php

declare(strict_types=1);

namespace Xttribute\Xttribute\Exceptions;

use DOMDocument;

class UnableToFindSingleNodeException extends IdentifyValueException
{
    public function __construct(
        string $message,
        public readonly DOMDocument $doc,
        public readonly string $xpath,
    ) {
        parent::__construct($message);
    }
}
