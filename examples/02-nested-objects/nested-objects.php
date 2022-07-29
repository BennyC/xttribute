<?php

use Xttribute\Xttribute\Castables\Caster;
use Xttribute\Xttribute\Castables\PathValue;
use Xttribute\Xttribute\DOMDocumentCaster;

require __DIR__ . '/../../vendor/autoload.php';

class Customer
{
    public function __construct(
        #[PathValue('/customer/name')]
        public readonly string $name,
        #[Caster('/customer/address', Address::class)]
        public readonly Address $address
    ) {
    }
}

class Address
{
    public function __construct(
        #[PathValue('/address/lineOne')]
        public readonly string $lineOne,
        #[PathValue('/address/lineTwo')]
        public readonly string $lineTwo,
    ) {
    }
}

$doc = new DOMDocument();
$doc->loadXML(file_get_contents(__DIR__ . '/nested-objects.xml'));

$caster = new DOMDocumentCaster();
$customer = $caster->cast($doc, Customer::class);

echo json_encode($customer, JSON_PRETTY_PRINT);
