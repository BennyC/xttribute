<?php

namespace Xttribute\Xttribute\Castables;

use DOMDocument;
use DOMNode;
use DOMXPath;

class ArrayElement implements Xttribute
{
    public function __construct(
        private readonly string $xpath
    ) {
    }

    public function value(DOMDocument $doc): array
    {
        $values = [];
        $nodeList = (new DOMXPath($doc))->query($this->xpath);

        /** @var DOMNode $node */
        foreach ($nodeList as $node) {
            $doc = new DOMDocument();
            $doc->appendChild($doc->importNode($node, true));

            $pathValue = new PathValue('/*');
            $values[] = $pathValue->value($doc);
        }

        return $values;
    }
}
