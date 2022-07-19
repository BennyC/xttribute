<?php

use Xttribute\Xttribute\ArrayElement;

test('it can pull strings into array', function () {
    $doc = loadXmlFixture('pet.xml');
    $caster = new ArrayElement('/pet/traits/trait');
    $values = $caster->value($doc);

    expect($values)
        ->toBeArray()
        ->toContain('Friendly', 'Bonkers');
});
