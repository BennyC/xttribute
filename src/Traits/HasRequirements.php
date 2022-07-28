<?php

namespace Xttribute\Xttribute\Traits;

use DOMDocument;
use DOMNode;
use DOMXPath;
use Xttribute\Xttribute\Exceptions\IdentifyValueException;
use Xttribute\Xttribute\Exceptions\UnableToFindSingleNodeException;

trait HasRequirements
{
    /**
     * DOMNodeList must contain a single DOMNode which has no children,
     * except a value
     * @throws IdentifyValueException
     */
    private function requireSingleDOMNode(DOMDocument $doc, string $xpath): DOMNode
    {
        $list = (new DOMXPath($doc))->query($xpath);
        if ($list->count() !== 1) {
            throw new UnableToFindSingleNodeException(
                "DOMNodeList does not contain single element",
                $doc,
                $xpath,
            );
        }

        return $list->item(0);
    }
}
