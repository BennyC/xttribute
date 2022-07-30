<?php

use Xttribute\Xttribute\Castables\Numeric;
use Xttribute\Xttribute\Castables\Str;
use Xttribute\Xttribute\DOMDocumentCaster;

require __DIR__ . '/../../vendor/autoload.php';

class Pet
{
    public function __construct(
        #[Str('/pet/name')]
        public readonly string $name,
        #[Numeric('/pet/stats/@age')]
        public readonly int $age
    ) {
    }

    public function __toString(): string
    {
        return sprintf(
            "My name is %s and I'm %d",
            $this->name,
            $this->age
        );
    }
}

$doc = new DOMDocument();
$doc->loadXML(file_get_contents(__DIR__ . '/getting-started.xml'));

$caster = new DOMDocumentCaster();
$pet = $caster->cast($doc, Pet::class);

echo $pet;
