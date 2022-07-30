<?php

declare(strict_types=1);

namespace Xttribute\Xttribute\Castables;

use Attribute;
use DOMDocument;
use Xttribute\Xttribute\Exceptions\IdentifyValueException;
use Xttribute\Xttribute\Exceptions\InvalidTypeException;

#[Attribute(Attribute::TARGET_PARAMETER)]
class Boolean extends Str
{
    /**
     * @throws InvalidTypeException
     * @throws IdentifyValueException
     */
    public function value(DOMDocument $doc): bool
    {
        $strValue = parent::value($doc);
        $boolValue = filter_var($strValue, FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE);
        if ($boolValue === null) {
            throw new InvalidTypeException(
                "Unable to cast value to boolean",
                "boolean",
                $strValue,
            );
        }

        return $boolValue;
    }
}
