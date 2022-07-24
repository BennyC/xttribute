<?php

use Xttribute\Xttribute\Castables\Boolean;
use Xttribute\Xttribute\Exceptions\InvalidTypeException;

test('it throws exceptions when value is not boolean', function () {
    $doc = loadXmlFixture('customer.xml');
    $caster = new Boolean('//customer/marketing/id');
    $value = $caster->value($doc);
})->throws(InvalidTypeException::class);
