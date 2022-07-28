<?php

namespace Fixtures;

use Xttribute\Xttribute\Castables\Numeric;
use Xttribute\Xttribute\Castables\PathValue;

class OrderItem
{
    public function __construct(
        #[Numeric('/item/@id')]
        public readonly int $id,
        #[PathValue('/item/name')]
        public readonly string $name
    ) {
    }
}
