<?php

use Xttribute\Xttribute\Castables\CastTo;
use Xttribute\Xttribute\Castables\Str;
use Xttribute\Xttribute\DOMDocumentCaster;

require __DIR__ . '/../../vendor/autoload.php';

class Customer
{
    public function __construct(
        #[Str('/customer/name')]
        public readonly string $name,
        #[CastTo('/customer/address', Address::class)]
        public readonly Address $address
    ) {
    }
}

class Address
{
    public function __construct(
        #[Str('/address/lineOne')]
        public readonly string $lineOne,
        #[Str('/address/lineTwo')]
        public readonly string $lineTwo,
    ) {
    }
}

$doc = new DOMDocument();
$doc->loadXML(file_get_contents(__DIR__ . '/nested-objects.xml'));

$caster = new DOMDocumentCaster();
$customer = $caster->cast($doc, Customer::class);

echo json_encode($customer, JSON_PRETTY_PRINT);
