<?php

use Xttribute\Xttribute\Castables\ArrayOf;
use Xttribute\Xttribute\Castables\Str;
use Xttribute\Xttribute\DOMDocumentCaster;

require __DIR__ . '/../../vendor/autoload.php';

class Pet
{
    public function __construct(
        #[Str('/pet/name')]
        public readonly string $name,
        #[ArrayOf('/pet/traits/trait')]
        public readonly array $traits
    ) {
    }
}

$doc = new DOMDocument();
$doc->loadXML(file_get_contents(__DIR__ . '/array-of-strings.xml'));

$caster = new DOMDocumentCaster();
$pet = $caster->cast($doc, Pet::class);

echo json_encode($pet, JSON_PRETTY_PRINT);
