<?php

namespace Xttribute\Xttribute\Castables;

use Attribute;
use DOMDocument;
use DOMNodeList;
use DOMXPath;
use Xttribute\Xttribute\Exceptions\IdentifyValueException;

#[Attribute(Attribute::TARGET_PROPERTY)]
class PathValue implements Xttribute
{
    public function __construct(
        private readonly string $xpath,
        private readonly string $castTo = 'string'
    ) {}

    /**
     * @throws IdentifyValueException
     */
    public function value(DOMDocument $doc): mixed
    {
        $nodeList = (new DOMXPath($doc))->query($this->xpath);

        return match ($this->castTo) {
            'string' => $this->string($nodeList),
            default  => null,
        };
    }

    /**
     * @throws IdentifyValueException
     */
    private function string(DOMNodeList $nodeList): string
    {
        $this->requireSingleDOMNode($nodeList);
        $node = $nodeList->item(0);

        return $node->nodeValue;
    }

    /**
     * DOMNodeList must contain a single DOMNode which has no children,
     * except a value
     * @throws IdentifyValueException
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
