<?php

namespace Xttribute\Xttribute;

use Attribute;
use DOMDocument;
use DOMNodeList;
use DOMXPath;
use Xttribute\Xttribute\Exceptions\IdentifyValueException;

#[Attribute(Attribute::TARGET_PROPERTY)]
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

    /**
     * DOMNodeList must contain a single DOMNode which has no children,
     * except a value
     */
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