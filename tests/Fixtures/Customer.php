<?php

namespace Fixtures;

use Xttribute\Xttribute\Castables\Caster;
use Xttribute\Xttribute\Castables\PathValue;

class Customer
{
    public function __construct(
        #[PathValue('/customer/name')]
        public readonly string $name,
        #[Caster('/customer/address', CustomerAddress::class)]
        public readonly CustomerAddress $address,
        #[Caster('/customer/marketing', Marketing::class)]
        public readonly Marketing $marketing,
    ) {
    }
}
