<?php

namespace Benchmarks;

use DOMDocument;
use DOMXPath;
use Fixtures\NameAndAgePet;
use Xttribute\Xttribute\DOMDocumentCaster;

class DOMDocumentCasterBench
{
    public function benchDOMDocumentCaster()
    {
        $doc = new DOMDocument();
        $caster = new DOMDocumentCaster();
        $doc->load(__DIR__ . '/../Fixtures/pet.xml');

        $pet = $caster->cast($doc, NameAndAgePet::class);
    }

    public function benchDOMDocumentManualCastingWithXPath()
    {
        $doc = new DOMDocument();
        $doc->load(__DIR__ . '/../Fixtures/pet.xml');
        $name = (new DOMXPath($doc))->query('/pet/name');
        $age = (new DOMXPath($doc))->query('/pet/stats/@age');

        $pet = new NameAndAgePet(
            $name->item(0)->nodeValue,
            $age->item(0)->nodeValue,
        );
    }
}
