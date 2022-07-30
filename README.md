# xttribute
![Tests & PHP CodeSniffer](https://github.com/BennyC/xttribute/actions/workflows/php.yml/badge.svg)
[![GitHub tag](https://img.shields.io/github/tag/BennyC/xttribute.svg)](https://GitHub.com/BennyC/xttribute/tags/)

xttribute will make dealing with XML a breeze! DOMDocuments can now be cast to classes with PHP 8.1 attributes!

## Getting started

### Requirements
- PHP 8.1

### Installation

Use [composer](https://getcomposer.org/) to install

```shell
composer require xttribute/xttribute
```

### Usage

Given the following XML
```xml
<?xml version="1.0" encoding="UTF-8"?>
<note>
  <to>Tove</to>
  <from>Jani</from>
  <heading>Reminder</heading>
  <body>Don't forget me this weekend!</body>
</note>
```

We can translate this easily to the following class with some attributes! 
```php
use Xttribute\Xttribute\Castable\Str;

class Note 
{
    public function __construct(
        #[Str('/note/to')]
        public readonly string $to,
        #[Str('/note/from')]
        public readonly string $from,
        #[Str('/note/heading')]
        public readonly string $heading,
        #[Str('/note/body')]
        public readonly string $body,
    ) {
    }
}
```

Then we can run it through our ```DomDocumentCaster``` and get our hydrated object!

```php
use Xttribute\Xttribute\DOMDocumentCaster;

// $source to be populated, however you're receiving your XML

$xml = new DOMDocument();
$xml->loadXML($source);

$caster = new DOMDocumentCaster();
$caster->cast($doc, Note::class)
```

Other ways of using this package can be found in our [examples](https://github.com/BennyC/xttribute/tree/main/examples).

---
## Contributing
Pull requests are welcome! For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

### Testing

```shell
composer test
```
---
### License
[MIT](https://choosealicense.com/licenses/mit/)
