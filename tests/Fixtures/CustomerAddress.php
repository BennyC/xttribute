<?php

namespace Fixtures;

use Xttribute\Xttribute\Castables\PathValue;

class CustomerAddress
{
    public function __construct(
        #[PathValue('/address/lineOne')]
        public readonly string $lineOne,
        #[PathValue('/address/lineTwo')]
        public readonly string $lineTwo,
        #[PathValue('/address/postCode')]
        public readonly string $postCode,
    ) {
    }
}
