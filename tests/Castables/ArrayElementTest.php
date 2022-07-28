<?php

use Fixtures\OrderItem;
use Pest\Expectation;
use Xttribute\Xttribute\Castables\ArrayElement;

test('it can pull strings into array', function () {
    $doc = loadXmlFixture('pet.xml');
    $caster = new ArrayElement('/pet/traits/trait');
    $values = $caster->value($doc);

    expect($values)
        ->toBeArray()
        ->toContain('Friendly', 'Bonkers');
});

test('it can pull complex objects into array', function () {
    $doc = loadXmlFixture('customer.xml');
    $caster = new ArrayElement('/customer/order/item', OrderItem::class);
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
