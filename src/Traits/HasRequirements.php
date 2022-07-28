<?php

namespace Xttribute\Xttribute\Traits;

use DOMNode;
use DOMNodeList;
use Xttribute\Xttribute\Exceptions\UnableToFindSingleNodeException;

trait HasRequirements
{
    /**
     * DOMNodeList must contain a single DOMNode which has no children,
     * except a value
     * @throws UnableToFindSingleNodeException
     */
    private function requireSingleDOMNode(DOMNodeList $list): DOMNode
    {
        if ($list->count() !== 1) {
            throw (new UnableToFindSingleNodeException())
                ->setDOMNodeList($list);
        }

        return $list->item(0);
    }
}
