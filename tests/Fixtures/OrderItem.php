<?php

namespace Fixtures;

use Xttribute\Xttribute\Castables\Numeric;
use Xttribute\Xttribute\Castables\Str;

class OrderItem
{
    public function __construct(
        #[Numeric('/item/@id')]
        public readonly int $id,
        #[Str('/item/name')]
        public readonly string $name
    ) {
    }
}
