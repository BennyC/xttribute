<?php

namespace Fixtures;

use Xttribute\Xttribute\Castables\Str;

class NamedPet
{
    public function __construct(
        #[Str("/pet/name")]
        public readonly string $name
    ) {
    }
}
