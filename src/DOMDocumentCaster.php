<?php

declare(strict_types=1);

namespace Xttribute\Xttribute;

use DOMDocument;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionException;
use Xttribute\Xttribute\Exceptions\IdentifyValueException;

/**
 * @template T
 */
class DOMDocumentCaster
{
    /**
     * @param DOMDocument $doc
     * @param T $castTo
     * @return T
     * @throws ReflectionException
     * @throws IdentifyValueException
     */
    public function cast(DOMDocument $doc, string $castTo): object
    {
        $caster = new Caster('/*', $castTo);
        return $caster->value($doc);
    }
}
