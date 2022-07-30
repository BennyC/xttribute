<?php

namespace Fixtures;

use Xttribute\Xttribute\Castables\Str;

class NameAndAgePet
{
    public function __construct(
        #[Str("/pet/name")]
        public readonly string $name,
        #[Str("/pet/stats/@age")]
        public readonly int $age
    ) {
    }
}
