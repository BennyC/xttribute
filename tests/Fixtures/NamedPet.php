<?php

namespace Fixtures;

use Xttribute\Xttribute\Castables\PathValue;

class NamedPet
{
    public function __construct(
        #[PathValue("/pet/name")]
        public readonly string $name
    ) {
    }
}
