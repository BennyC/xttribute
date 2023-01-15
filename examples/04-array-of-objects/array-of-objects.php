<?php

use Xttribute\Xttribute\Castables\ArrayOf;
use Xttribute\Xttribute\Castables\Str;
use Xttribute\Xttribute\Castables\Enum;
use Xttribute\Xttribute\DOMDocumentCaster;

require __DIR__ . '/../../vendor/autoload.php';

class Customer
{
    public function __construct(
        #[Str('/customer/name')]
        public readonly string $name,
        #[ArrayOf('/customer/order/item', OrderItem::class)]
        public readonly array $orderItems
    ) {
    }
}

class OrderItem
{
    public function __construct(
        #[Str('/item/@id')]
        public readonly string $id,
        #[Str('/item/name')]
        public readonly string $name,
        #[Enum('/item/type', ItemType::class)]
        public readonly ItemType $type,
    ) {
    }
}

enum ItemType: string
{
    case Candy = 'Candy';
    case Gum = 'Gum';
}

$doc = new DOMDocument();
$doc->loadXML(file_get_contents(__DIR__ . '/array-of-objects.xml'));

$caster = new DOMDocumentCaster();
$customer = $caster->cast($doc, Customer::class);

echo json_encode($customer, JSON_PRETTY_PRINT);
