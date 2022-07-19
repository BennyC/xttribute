<?php

declare(strict_types=1);

namespace Xttribute\Xttribute;

use DOMDocument;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionException;

/**
 * @template T
 */
class DOMDocumentCaster
{
    /**
     * @param DOMDocument $doc
     * @param T $castTo
     * @return object
     * @throws ReflectionException
     */
    public function cast(DOMDocument $doc, string $castTo): object
    {
        $values = [];
        $ref = new ReflectionClass($castTo);

        foreach ($ref->getProperties() as $prop) {
            /** @var Xttribute $attr */
            foreach ($prop->getAttributes(Xttribute::class, ReflectionAttribute::IS_INSTANCEOF) as $attrRef) {
                $attr = $attrRef->newInstance();
                $values[] = $attr->value($doc);
            }
        }

        return $ref->newInstance(...$values);
    }
}
