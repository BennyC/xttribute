<?php

namespace Fixtures;

use Xttribute\Xttribute\Caster;
use Xttribute\Xttribute\PathValue;

class Customer
{
    public function __construct(
        #[PathValue('/customer/name')]
        public readonly string $name,
        #[Caster('/customer/address', CustomerAddress::class)]
        public readonly CustomerAddress $address,
        #[Caster('/customer/marketing', Marketing::class)]
        public readonly Marketing $marketing,
    ) {}
}
