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
