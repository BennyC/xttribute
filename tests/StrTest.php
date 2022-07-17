<?php

use Xttribute\Xttribute\Exceptions\IdentifyValueException;
use Xttribute\Xttribute\Str;

test('find str value within document', function () {
    $doc = new DOMDocument();
    $doc->load(__DIR__ . '/fixtures/pet.xml');
    $str = new Str('//pet/name');

    $value = $str->value($doc);
    expect($value)->toBe('Bear');
});

test('throws exception when node does not have simple value', function () {
    $doc = new DOMDocument();
    $doc->load(__DIR__ . '/fixtures/pet.xml');

    $str = new Str('//pet/traits');
    $value = $str->value($doc);
})->throws(IdentifyValueException::class);
