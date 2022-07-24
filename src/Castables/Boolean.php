<?php

namespace Xttribute\Xttribute\Castables;

use Attribute;
use DOMDocument;
use Xttribute\Xttribute\Exceptions\IdentifyValueException;
use Xttribute\Xttribute\Exceptions\InvalidTypeException;

#[Attribute(Attribute::TARGET_PARAMETER)]
class Boolean extends PathValue
{
    /**
     * @throws InvalidTypeException
     * @throws IdentifyValueException
     */
    public function value(DOMDocument $doc): mixed
    {
        $strValue = parent::value($doc);
        $boolValue = filter_var($strValue, FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE);
        if ($boolValue === null) {
            throw new InvalidTypeException();
        }

        return $boolValue;
    }
}
