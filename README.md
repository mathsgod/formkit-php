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


### Registering custom Vue components

```php

$schema = new FormKit\Schema();
$schema->registerClass("q-card", FormKit\Component::class);
$schema->appendHTML("<q-card flat>Hello</q-card>");

echo json_encode($schema, JSON_PRETTY_PRINT);

```

### Registering custom FormKit input components

```php
$schema = new FormKit\Schema();
$schema->registerInputClass("my-input", FormKit\FormKitInputs::class);
$schema->appendHTML("<form-kit label='My custom input' type='my-input'/>");
```


