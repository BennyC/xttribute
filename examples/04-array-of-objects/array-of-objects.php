<?php

use Xttribute\Xttribute\Castables\ArrayElement;
use Xttribute\Xttribute\Castables\PathValue;
use Xttribute\Xttribute\DOMDocumentCaster;

require __DIR__ . '/../../vendor/autoload.php';

class Customer
{
    public function __construct(
        #[PathValue('/customer/name')]
        public readonly string $name,
        #[ArrayElement('/customer/order/item', OrderItem::class)]
        public readonly array $orderItems
    ) {
    }
}

class OrderItem
{
    public function __construct(
        #[PathValue('/item/@id')]
        public readonly string $id,
        #[PathValue('/item/name')]
        public readonly string $name,
    ) {
    }
}

$doc = new DOMDocument();
$doc->loadXML(file_get_contents(__DIR__ . '/array-of-objects.xml'));

$caster = new DOMDocumentCaster();
$customer = $caster->cast($doc, Customer::class);

echo json_encode($customer, JSON_PRETTY_PRINT);
