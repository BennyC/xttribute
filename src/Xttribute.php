<?php

namespace Xttribute\Xttribute;

use Attribute;
use DOMDocument;

#[Attribute(Attribute::TARGET_PROPERTY)]
interface Xttribute
{
    public function value(DOMDocument $doc): mixed;
}
