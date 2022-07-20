<?php

use Fixtures\{NameAndAgePet, NamedPet};
use Xttribute\Xttribute\DOMDocumentCaster;

test('simple path value sets property', function () {
    $doc = loadXmlFixture('pet.xml');

    $caster = new DOMDocumentCaster();
    $simple = $caster->cast($doc, NamedPet::class);

    expect($simple)
        ->toBeInstanceOf(NamedPet::class)
        ->and($simple->name)
        ->toEqual('Bear');
});

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

