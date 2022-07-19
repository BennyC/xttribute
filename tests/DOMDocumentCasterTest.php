<?php

use Xttribute\Xttribute\DOMDocumentCaster;
use Xttribute\Xttribute\PathValue;

class NamedPet {
    public function __construct(
        #[PathValue("/pet/name")]
        public readonly string $name
    ) {}
}

test('simple path value sets property', function () {
    $doc = loadXmlFixture('pet.xml');

    $caster = new DOMDocumentCaster();
    $simple = $caster->cast($doc, NamedPet::class);

    expect($simple)
        ->toBeInstanceOf(NamedPet::class)
        ->and($simple->name)
        ->toEqual('Bear');
});

class NameAndAgePet {
    public function __construct(
        #[PathValue("/pet/name")]
        public readonly string $name,
        #[PathValue("/pet/stats/@age")]
        public readonly int $age
    ) {}
}

test('attribute sets property value', function () {
    $doc = loadXmlFixture('pet.xml');

    $caster = new DOMDocumentCaster();
    $simple = $caster->cast($doc, NameAndAgePet::class);

    expect($simple)
        ->toBeInstanceOf(NameAndAgePet::class)
        ->and($simple->name)
        ->toEqual('Bear')
        ->and($simple->age)
        ->toEqual(4);
});

