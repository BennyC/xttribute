<?php

namespace Fixtures;

use Xttribute\Xttribute\PathValue;

class NamedPet
{
    public function __construct(
        #[PathValue("/pet/name")]
        public readonly string $name
    ) {}
}
