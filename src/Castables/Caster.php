<?php

namespace Xttribute\Xttribute\Castables;

use Attribute;
use DOMDocument;
use DOMXPath;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionException;
use Xttribute\Xttribute\Exceptions\IdentifyValueException;
use Xttribute\Xttribute\Traits\HasRequirements;

/**
 * @template T
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Caster implements Xttribute
{
    use HasRequirements;

    /**
     * @param string $xpath
     * @param T $castTo
     */
    public function __construct(
        private readonly string $xpath,
        private readonly string $castTo
    ) {
    }

    /**
     * @param DOMDocument $doc
     * @return T
     * @throws ReflectionException
     * @throws IdentifyValueException
     */
    public function value(DOMDocument $doc): mixed
    {
        $values = [];
        $ref = new ReflectionClass($this->castTo);
        $node = $this->requireSingleDOMNode($doc, $this->xpath);

        $scopedDoc = new DomDocument();
        $scopedDoc->appendChild($scopedDoc->importNode($node, true));

        foreach ($ref->getProperties() as $prop) {
            /** @var Xttribute $attr */
            foreach ($prop->getAttributes(Xttribute::class, ReflectionAttribute::IS_INSTANCEOF) as $attrRef) {
                $attr = $attrRef->newInstance();
                $values[] = $attr->value($scopedDoc);
            }
        }

        return $ref->newInstance(...$values);
    }
}
