<?php

namespace Fixtures;

use Xttribute\Xttribute\PathValue;

class Customer
{
    public function __construct(
        #[PathValue('/customer/name')]
        public readonly string $name,
        #[PathValue('/customer/address')]
        public readonly CustomerAddress $address,
    ) {}
}
