<?php

declare(strict_types=1);

namespace Xttribute\Xttribute\Castables;

use Attribute;
use DOMDocument;
use Xttribute\Xttribute\Exceptions\IdentifyValueException;
use Xttribute\Xttribute\Exceptions\InvalidTypeException;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Numeric extends PathValue
{
    /**
     * @throws InvalidTypeException
     * @throws IdentifyValueException
     */
    public function value(DOMDocument $doc): mixed
    {
        $strValue = parent::value($doc);
        if (! is_numeric($strValue)) {
            throw new InvalidTypeException(
                "Unable to cast value to numeric value",
                "numeric",
                $strValue,
            );
        }

        return $strValue;
    }
}
