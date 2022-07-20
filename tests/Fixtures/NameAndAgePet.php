<?php

namespace Fixtures;

use Xttribute\Xttribute\Castables\PathValue;

class NameAndAgePet {
    public function __construct(
        #[PathValue("/pet/name")]
        public readonly string $name,
        #[PathValue("/pet/stats/@age")]
        public readonly int $age
    ) {}
}
