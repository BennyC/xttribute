<?php

namespace Xttribute\Xttribute;

use DOMNode;
use DOMNodeList;
use Xttribute\Xttribute\Exceptions\IdentifyValueException;

trait HasRequirements
{
    /**
     * DOMNodeList must contain a single DOMNode which has no children,
     * except a value
     * @throws IdentifyValueException
     */
    private function requireSingleDOMNode(DOMNodeList $list): DOMNode
    {
        if ($list->count() !== 1) {
            throw new IdentifyValueException();
        }

        return $list->item(0);
    }
}
