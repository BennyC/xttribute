<?php

use Fixtures\{Customer, Marketing, MarketingPreferences, NameAndAgePet, NamedPet};
use Xttribute\Xttribute\DOMDocumentCaster;

test('simple path value sets property', function () {
    $doc = loadXmlFixture('pet.xml');

    $caster = new DOMDocumentCaster();
    $simple = $caster->cast($doc, NamedPet::class);

    expect($simple)
        ->toBeInstanceOf(NamedPet::class)
        ->and($simple->name)
        ->toEqual('Bear');
});

test('attribute sets property value', function () {
    $doc = loadXmlFixture('pet.xml');

    $caster = new DOMDocumentCaster();
    $simple = $caster->cast($doc, NameAndAgePet::class);

    expect($simple)
        ->toBeInstanceOf(NameAndAgePet::class)
        ->and($simple->name)
        ->toEqual('Bear')
        ->and($simple->age)
        ->toEqual(4);
});

test('will attributes cast to other classes and populate', function () {
    $doc = loadXmlFixture('customer.xml');

    $caster = new DOMDocumentCaster();
    $customer = $caster->cast($doc, Customer::class);

    expect($customer)
        ->toBeInstanceOf(Customer::class)
        ->and($customer->name)
        ->toEqual('John Doe')
        ->and($customer->address)
        ->not()
        ->toBeNull()
        ->and($customer->address->lineOne)
        ->toBe('1 Baker Street')
        ->and($customer->marketing)
        ->toBeInstanceOf(Marketing::class)
        ->and($customer->marketing->id)
        ->toEqual('1234')
        ->and($customer->marketing->preferences)
        ->toBeInstanceOf(MarketingPreferences::class)
        ->and($customer->marketing->preferences->email)
        ->toBeFalse();
});
