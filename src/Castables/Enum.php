<?php

declare(strict_types=1);

namespace Xttribute\Xttribute\Castables;

use Attribute;
use DOMDocument;
use Xttribute\Xttribute\Exceptions\IdentifyValueException;
use Xttribute\Xttribute\Traits\HasRequirements;
use Xttribute\Xttribute\Exceptions\InvalidTypeException;

/**
 * @template T
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Enum implements Xttribute
{
    use HasRequirements;

    /**
     * @param T $enumClass
     */
    public function __construct(
        public readonly string $xpath,
        public readonly string $enumClass,
        public readonly bool $required = true,
    ) {
    }

    /**
     * @param DOMDocument $doc
     *
     * @return T
     * @throws IdentifyValueException
     * @throws InvalidTypeException
     * @throws \ReflectionException
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

        if (!is_a($this->enumClass, \BackedEnum::class, true)) {
            throw new InvalidTypeException(
                '`enumClass` is not a \\BackedEnum',
                $this->enumClass,
                $node->nodeValue
            );
        }

        $backingType = (string) (new \ReflectionEnum($this->enumClass))->getBackingType();
        try {
            return $this->enumClass::from(
                $backingType === 'int' ? (int) $node->nodeValue : $node->nodeValue
            );
        } catch (\ValueError $e) {
            if ($this->required) {
                throw new InvalidTypeException(
                    $e->getMessage(),
                    $this->enumClass,
                    $node->nodeValue
                );
            }

            return null;
        }
    }
}
