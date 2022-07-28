<?php

namespace Xttribute\Xttribute\Castables;

use Attribute;
use DOMDocument;
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
     * @param T $castTo
     */
    public function __construct(
        public readonly string $xpath,
        public readonly string $castTo,
        public readonly bool $required = true,
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
        try {
            $node = $this->requireSingleDOMNode($doc, $this->xpath);
        } catch (IdentifyValueException $e) {
            if ($this->required === true) {
                throw $e;
            }

            return null;
        }

        $scopedDoc = new DomDocument();
        $scopedDoc->appendChild($scopedDoc->importNode($node, true));

        $values = [];
        $ref = new ReflectionClass($this->castTo);
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
