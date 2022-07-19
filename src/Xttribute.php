<?php

namespace Xttribute\Xttribute;

use DOMDocument;

interface Xttribute
{
    public function value(DOMDocument $doc): string;
}
