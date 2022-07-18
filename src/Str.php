<?php

namespace Xttribute\Xttribute;

use DOMDocument;
use DOMXPath;
use RuntimeException;
use Xttribute\Xttribute\Exceptions\IdentifyValueException;

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
            throw new IdentifyValueException();
        }

        $node = $nodeList->item(0);
        if ($node->hasChildNodes() && $node->childNodes->count() > 1) {
            throw new IdentifyValueException();
        }

        return $node->nodeValue;
    }
}
