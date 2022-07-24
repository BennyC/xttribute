<?php

use Xttribute\Xttribute\Castables\Numeric;
use Xttribute\Xttribute\Exceptions\InvalidTypeException;

test('it throws exceptions when value is not numeric', function () {
    $doc = loadXmlFixture('pet.xml');
    $caster = new Numeric('//pet/name');
    $value = $caster->value($doc);
})->throws(InvalidTypeException::class);
