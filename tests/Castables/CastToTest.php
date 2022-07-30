<?php

use Fixtures\NamedPet;
use Xttribute\Xttribute\Castables\CastTo;
use Xttribute\Xttribute\Exceptions\IdentifyValueException;

test('it casts to an object', function () {
    $doc = loadXmlFixture('pet.xml');
    $caster = new CastTo('/pet', NamedPet::class);
    $pet = $caster->value($doc);

    expect($pet)
        ->toBeInstanceOf(NamedPet::class)
        ->and($pet->name)
        ->toEqual('Bear');
});

test('it throws exception when property is required', function () {
    $doc = loadXmlFixture('empty.xml');
    $caster = new CastTo(
        '/scenarios/does-not-exist',
        castTo: NamedPet::class,
        required: true
    );

    $nulled = $caster->value($doc);
})->throws(IdentifyValueException::class);

test('it handle nulls when property is not required', function () {
    $doc = loadXmlFixture('empty.xml');
    $caster = new CastTo(
        '/scenarios/does-not-exist',
        castTo: NamedPet::class,
        required: false
    );

    $nulled = $caster->value($doc);
    expect($nulled)->toBeNull();
});
