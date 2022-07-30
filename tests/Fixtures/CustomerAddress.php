<?php

namespace Fixtures;

use Xttribute\Xttribute\Castables\Str;

class CustomerAddress
{
    public function __construct(
        #[Str('/address/lineOne')]
        public readonly string $lineOne,
        #[Str('/address/lineTwo')]
        public readonly string $lineTwo,
        #[Str('/address/postCode')]
        public readonly string $postCode,
    ) {
    }
}
