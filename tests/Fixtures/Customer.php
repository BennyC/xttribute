<?php

namespace Fixtures;

use Xttribute\Xttribute\Castables\CastTo;
use Xttribute\Xttribute\Castables\Str;

class Customer
{
    public function __construct(
        #[Str('/customer/name')]
        public readonly string $name,
        #[CastTo('/customer/address', CustomerAddress::class)]
        public readonly CustomerAddress $address,
        #[CastTo('/customer/marketing', Marketing::class)]
        public readonly Marketing $marketing,
    ) {
    }
}
