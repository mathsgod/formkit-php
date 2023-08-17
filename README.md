# formkit-php

A PHP library for generating <a href="https://formkit.com/essentials/schema">FormKit Schema</a> from PHP classes.


## Installation

Install via composer:

```bash
composer require mathsgod/formkit-php
```

## Usage

### Basic Usage

```php

$schema = new FormKit\Schema();

$schema->appendHTML("<form-kit label='hello' type='text'/>");

echo json_encode($schema, JSON_PRETTY_PRINT);

```



