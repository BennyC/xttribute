<?php

namespace Xttribute\Xttribute\Castables;

use Attribute;
use DOMDocument;
use Xttribute\Xttribute\Exceptions\IdentifyValueException;
use Xttribute\Xttribute\Exceptions\MoreThanOneChildNodeException;
use Xttribute\Xttribute\Traits\HasRequirements;

#[Attribute(Attribute::TARGET_PROPERTY)]
class PathValue implements Xttribute
{
    use HasRequirements;

    public function __construct(
        protected readonly string $xpath,
        protected readonly string $castTo = 'string'
    ) {
    }

    /**
     * @throws IdentifyValueException
     */
    public function value(DOMDocument $doc): mixed
    {
        return match ($this->castTo) {
            'string' => $this->string($doc, $this->xpath),
            default  => null,
        };
    }

    /**
     * @throws IdentifyValueException
     */
    private function string(DOMDocument $doc, string $xpath): string
    {
        $node = $this->requireSingleDOMNode($doc, $xpath);
        if ($node->hasChildNodes() && $node->childNodes->count() > 1) {
            throw new MoreThanOneChildNodeException(
                "DOMNode contains more than one child",
                $doc,
                $xpath,
            );
        }

        return $node->nodeValue;
    }
}
