<?php

declare(strict_types=1);

namespace Xttribute\Xttribute\Castables;

use DOMDocument;

interface Xttribute
{
    public function value(DOMDocument $doc): mixed;
}
