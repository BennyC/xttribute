<?php

namespace Xttribute\Xttribute\Castables;

use Attribute;
use DOMDocument;
use DOMNodeList;
use DOMXPath;
use Xttribute\Xttribute\Exceptions\IdentifyValueException;
use Xttribute\Xttribute\HasRequirements;

#[Attribute(Attribute::TARGET_PROPERTY)]
class PathValue implements Xttribute
{
    use HasRequirements;

    public function __construct(
        private readonly string $xpath,
        private readonly string $castTo = 'string'
    ) {
    }

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
        $node = $this->requireSingleDOMNode($nodeList);
        if ($node->hasChildNodes() && $node->childNodes->count() > 1) {
            throw new IdentifyValueException();
        }

        return $node->nodeValue;
    }
}
