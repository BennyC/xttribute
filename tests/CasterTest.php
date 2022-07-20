<?php

use Fixtures\NamedPet;
use Xttribute\Xttribute\Caster;

test('it casts to an object', function () {
    $doc = loadXmlFixture('pet.xml');
    $caster = new Caster('/pet', NamedPet::class);
    $pet = $caster->value($doc);

    expect($pet)
        ->toBeInstanceOf(NamedPet::class)
        ->and($pet->name)
        ->toEqual('Bear');
});
