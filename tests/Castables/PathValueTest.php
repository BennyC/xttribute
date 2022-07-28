<?php

use Xttribute\Xttribute\Castables\PathValue;
use Xttribute\Xttribute\Exceptions\IdentifyValueException;

test('find str value within document', function () {
    $doc = loadXmlFixture('pet.xml');
    $str = new PathValue('//pet/name');

    expect($str->value($doc))->toBe('Bear');
});

test('throws exception when node does not have simple value', function () {
    $doc = loadXmlFixture('pet.xml');

    $str = new PathValue('//pet/traits');
    $value = $str->value($doc);
})->throws(IdentifyValueException::class);

test('it can handle when empty values', function () {
    $doc = loadXmlFixture('empty.xml');
    $str = new PathValue('/scenarios/empty');
    $value = $str->value($doc);

    expect($value)
        ->toBeEmpty();
});

test('it does not trim empty strings', function () {
    $doc = loadXmlFixture('empty.xml');
    $str = new PathValue('/scenarios/empty-string');
    $value = $str->value($doc);

    expect($value)
        ->toBe(' ');
});

test('it can handle missing fields when not required', function () {
    $doc = loadXmlFixture('empty.xml');
    $str = new PathValue(
        '/scenarios/this-xml-field-definitely-does-not-exist',
        required: false,
    );
    $value = $str->value($doc);

    expect($value)
        ->toBeNull();
});
