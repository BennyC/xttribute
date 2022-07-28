<?php

namespace Xttribute\Xttribute\Exceptions;

use DOMNodeList;

class UnableToFindSingleNodeException extends IdentifyValueException
{
    protected DOMNodeList $list;

    public function setDOMNodeList(DOMNodeList $list): static
    {
        $this->list = $list;
        return $this;
    }

    public function getDOMNodeList(): DOMNodeList
    {
        return $this->list;
    }
}
