<?php

use Xttribute\Xttribute\Exceptions\IdentifyValueException;
use Xttribute\Xttribute\PathValue;

test('find str value within document', function () {
    $doc = loadXmlFixture('pet.xml');
    $str = new PathValue('//pet/name');

    $value = $str->value($doc);
    expect($value)->toBe('Bear');
});

test('throws exception when node does not have simple value', function () {
    $doc = loadXmlFixture('pet.xml');

    $str = new PathValue('//pet/traits');
    $value = $str->value($doc);
})->throws(IdentifyValueException::class);
