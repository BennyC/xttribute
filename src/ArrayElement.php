<?php

namespace Xttribute\Xttribute;

use DOMDocument;
use DOMNode;
use DOMXPath;
use Xttribute\Xttribute\Exceptions\IdentifyValueException;

class ArrayElement implements Xttribute
{
    public function __construct(
        private readonly string $xpath
    ) {}

    public function value(DOMDocument $doc): array
    {
        $values = [];
        $nodeList = (new DOMXPath($doc))->query($this->xpath);

        /** @var DOMNode $node */
        foreach ($nodeList as $node) {
            $this->requireContainsOnlyText($node);
            $values[] = $node->nodeValue;
        }

        return $values;
    }

    private function requireContainsOnlyText(DOMNode $node): void
    {
        if ($node->hasChildNodes() && $node->childNodes->count() > 1) {
            throw new IdentifyValueException();
        }
    }
}
