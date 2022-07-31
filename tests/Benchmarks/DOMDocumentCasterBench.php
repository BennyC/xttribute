<?php

namespace Benchmarks;

use DOMDocument;
use DOMXPath;
use Fixtures\NameAndAgePet;
use SimpleXMLElement;
use Xttribute\Xttribute\DOMDocumentCaster;

class DOMDocumentCasterBench
{
    public function benchDOMDocumentCaster(): void
    {
        $doc = new DOMDocument();
        $caster = new DOMDocumentCaster();
        $doc->load(__DIR__ . '/../Fixtures/pet.xml');

        $pet = $caster->cast($doc, NameAndAgePet::class);
    }

    public function benchDOMDocumentManualCastingWithXPath(): void
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

    public function benchSimpleXML(): void
    {
        $xml = simplexml_load_file(__DIR__ . '/../Fixtures/pet.xml');

        $pet = new NameAndAgePet(
            $xml->name,
            (int) $xml->xpath('/pet/stats/@age'),
        );
    }
}
