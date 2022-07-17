<?php

namespace Xttribute\Xttribute;

use DOMDocument;
use DOMXPath;
use RuntimeException;

class Str implements Xttribute
{
    public function __construct(
        private readonly string $xpath
    ) {}

    public function value(DOMDocument $doc): string
    {
        $xpath = new DOMXPath($doc);
        $nodeList = $xpath->query($this->xpath);
        if ($nodeList->count() > 1) {
            throw new RuntimeException();
        }

        $node = $nodeList->item(0);
        if ($node->hasChildNodes()) {
            throw new RuntimeException();
        }

        return $node->nodeValue;
    }
}
