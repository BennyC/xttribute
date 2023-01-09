<?php

declare(strict_types=1);

namespace Xttribute\Xttribute;

use DOMDocument;
use ReflectionException;
use Xttribute\Xttribute\Castables\CastTo;
use Xttribute\Xttribute\Exceptions\IdentifyValueException;

class DOMDocumentCaster
{
    /**
     * @template T of object
     * @param DOMDocument $doc
     * @param class-string<T> $castTo
     * @return T
     * @throws ReflectionException
     * @throws IdentifyValueException
     */
    public function cast(DOMDocument $doc, string $castTo): object
    {
        $caster = new CastTo('/*', $castTo);
        return $caster->value($doc);
    }
}
