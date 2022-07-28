<?php

declare(strict_types=1);

namespace Xttribute\Xttribute\Castables;

use Attribute;
use DOMDocument;

#[Attribute(Attribute::TARGET_PROPERTY)]
interface Xttribute
{
    public function value(DOMDocument $doc): mixed;
}
