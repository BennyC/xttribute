<?php

namespace Xttribute\Xttribute;

use Attribute;
use DOMDocument;
use DOMNodeList;
use DOMXPath;
use Xttribute\Xttribute\Exceptions\IdentifyValueException;

#[Attribute(Attribute::TARGET_PARAMETER)]
class PathValue implements Xttribute
{
    public function __construct(
        private readonly string $xpath
    ) {}

    /**
     * @throws IdentifyValueException
     */
    public function value(DOMDocument $doc): string
    {
        $nodeList = (new DOMXPath($doc))->query($this->xpath);
        $this->requireSingleDOMNode($nodeList);

        $node = $nodeList->item(0);
        return $node->nodeValue;
    }

    private function requireSingleDOMNode(DOMNodeList $list): void
    {
        if ($list->count() > 1) {
            throw new IdentifyValueException();
        }

        $node = $list->item(0);
        if ($node->hasChildNodes() && $node->childNodes->count() > 1) {
            throw new IdentifyValueException();
        }
    }
}
