<?php

use Fixtures\OrderItem;
use Pest\Expectation;
use Xttribute\Xttribute\Castables\ArrayOf;

test('it can pull strings into array', function () {
    $doc = loadXmlFixture('pet.xml');
    $caster = new ArrayOf('/pet/traits/trait');
    $values = $caster->value($doc);

    expect($values)
        ->toBeArray()
        ->toContain('Friendly', 'Bonkers');
});

test('it can pull complex objects into array', function () {
    $doc = loadXmlFixture('customer.xml');
    $caster = new ArrayOf('/customer/order/item', OrderItem::class);
    $values = $caster->value($doc);

    expect($values)
        ->each(function (Expectation $item) {
            $item->toBeInstanceOf(OrderItem::class)
                ->and($item->value->id)
                ->toBeIn([1, 2])
                ->and($item->value->name)
                ->toBe('Item');
        });
});
