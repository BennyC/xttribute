<?php

declare(strict_types=1);

namespace Xttribute\Xttribute\Castables;

use Attribute;
use DOMDocument;
use Xttribute\Xttribute\Exceptions\IdentifyValueException;
use Xttribute\Xttribute\Exceptions\MoreThanOneChildNodeException;
use Xttribute\Xttribute\Traits\HasRequirements;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Str implements Xttribute
{
    use HasRequirements;

    public function __construct(
        protected readonly string $xpath,
        protected readonly bool $required = true,
    ) {
    }

    /**
     * @throws IdentifyValueException
     */
    public function value(DOMDocument $doc): mixed
    {
        try {
            $node = $this->requireSingleDOMNode($doc, $this->xpath);
        } catch (IdentifyValueException $e) {
            // if the property is required, and it is flagged
            // as required, bubble up the exception
            if ($this->required === true) {
                throw $e;
            }

            return null;
        }

        if ($node->hasChildNodes() && $node->childNodes->count() > 1) {
            throw new MoreThanOneChildNodeException(
                "DOMNode contains more than one child",
                $doc,
                $this->xpath,
            );
        }

        return $node->nodeValue;
    }
}
