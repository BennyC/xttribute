<?php

use Fixtures\ColorEnumBacked;
use Fixtures\NumericEnumBacked;
use Fixtures\ColorEnum;
use Xttribute\Xttribute\Castables\Enum;
use Xttribute\Xttribute\Exceptions\IdentifyValueException;
use Xttribute\Xttribute\Exceptions\InvalidTypeException;

test('it casts to a string-backed enum', function () {
    $doc = loadXmlFixture('pet.xml');
    $caster = new Enum('/pet/color', ColorEnumBacked::class);
    $color = $caster->value($doc);

    expect($color)->toBe(ColorEnumBacked::Brown);
});

test('it casts to an integer-backed enum', function () {
    $doc = loadXmlFixture('pet.xml');
    $caster = new Enum('/pet/is_cute', NumericEnumBacked::class);
    $color = $caster->value($doc);

    expect($color)->toBe(NumericEnumBacked::Yes);
});

test('it throws exception when property is not a backed enum', function () {
    $doc = loadXmlFixture('pet.xml');
    $caster = new Enum(
        '/pet/color',
        enumClass: ColorEnum::class,
        required: true
    );

    $caster->value($doc);
})->throws(InvalidTypeException::class);

test('it throws exception when property is required', function () {
    $doc = loadXmlFixture('empty.xml');
    $caster = new Enum(
        '/scenarios/does-not-exist',
        enumClass: ColorEnumBacked::class,
        required: true
    );

    $caster->value($doc);
})->throws(IdentifyValueException::class);

test('it handles `null` when property is not required', function () {
    $doc = loadXmlFixture('empty.xml');
    $caster = new Enum(
        '/scenarios/does-not-exist',
        enumClass: ColorEnumBacked::class,
        required: false
    );

    $nulled = $caster->value($doc);
    expect($nulled)->toBeNull();
});

test('it handles unmatched enum cases when not required', function () {
    $doc = loadXmlFixture('pet.xml');
    $caster = new Enum(
        '/pet/name',
        enumClass: ColorEnumBacked::class,
        required: false
    );

    $unmatchedButNull = $caster->value($doc);
    expect($unmatchedButNull)->toBeNull();
});

test('it throws exception with an unmatched enum case when it is required', function () {
    $doc = loadXmlFixture('pet.xml');
    $caster = new Enum(
        '/pet/name',
        enumClass: ColorEnumBacked::class,
        required: true
    );

    $caster->value($doc);
})->throws(InvalidTypeException::class);
