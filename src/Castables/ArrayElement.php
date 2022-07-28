<?php

namespace Xttribute\Xttribute\Castables;

use Attribute;
use DOMDocument;
use DOMNode;
use DOMXPath;

#[Attribute(Attribute::TARGET_PROPERTY)]
class ArrayElement implements Xttribute
{
    public function __construct(
        private readonly string $xpath,
        private readonly string $castTo = 'string'
    ) {
    }

    public function value(DOMDocument $doc): array
    {
        $values = [];
        $nodeList = (new DOMXPath($doc))->query($this->xpath);

        /** @var DOMNode $node */
        foreach ($nodeList as $node) {
            $doc = new DOMDocument();
            $doc->appendChild($doc->importNode($node, true));

            $caster = $this->getCaster();
            $values[] = $caster->value($doc);
        }

        return $values;
    }

    private function getCaster(): Xttribute
    {
        return match ($this->castTo) {
            'string'  => new PathValue('/*'),
            'numeric' => new Numeric('/*'),
            'boolean' => new Boolean('/*'),
            default   => new Caster('/*', $this->castTo),
        };
    }
}
