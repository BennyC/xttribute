<?php

use Xttribute\Xttribute\Castables\ArrayElement;
use Xttribute\Xttribute\Castables\PathValue;
use Xttribute\Xttribute\DOMDocumentCaster;

require __DIR__ . '/../../vendor/autoload.php';

class Pet
{
    public function __construct(
        #[PathValue('/pet/name')]
        public readonly string $name,
        #[ArrayElement('/pet/traits/trait')]
        public readonly array $traits
    ) {
    }
}

$doc = new DOMDocument();
$doc->loadXML(file_get_contents(__DIR__ . '/array-of-strings.xml'));

$caster = new DOMDocumentCaster();
$pet = $caster->cast($doc, Pet::class);

echo json_encode($pet, JSON_PRETTY_PRINT);
