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

output:

```json
[
    {
        "$formkit": "text",
        "label": "hello"
    }
]
```

### Simple element 

```php

$schema = new FormKit\Schema();
$schema->appendElement("div")->appendElement("span")->appendHTML("hello");
echo json_encode($schema, JSON_PRETTY_PRINT);
```

output:

```json
[
    {
        "$el": "div",
        "children": [
            {
                "$el": "span",
                "children": [
                    "hello"
                ]
            }
        ]
    }
]
```

### Component

```php

$schema = new FormKit\Schema();
$card=$schema->appendComponent("q-card");
$card->setAttribute("flat","");

echo json_encode($schema, JSON_PRETTY_PRINT);
    
```

output:

```json
[
    {
        "$cmp": "q-card",
        "props": {
            "flat": true
        }
    }
]
```


### Registering custom Vue components

```php

$schema = new FormKit\Schema();
$schema->registerClass("q-card", FormKit\Component::class);
$schema->appendHTML("<q-card flat>Hello</q-card>");

echo json_encode($schema, JSON_PRETTY_PRINT);

```

output:

```json
[
    {
        "$cmp": "q-card",
        "props": {
            "flat": true
        },
        "children": [
            "Hello"
        ]
    }
]
```


### Registering custom FormKit input components

```php
$schema = new FormKit\Schema();
$schema->registerInputClass("my-input", FormKit\FormKitInputs::class);
$schema->appendHTML("<form-kit label='My custom input' type='my-input'/>");
echo json_encode($schema, JSON_PRETTY_PRINT);
```

output:

```json
[
    {
        "$formkit": "my-input",
        "label": "My custom input"
    }
]
```


### Custom component class

```php

class QBtn extends FormKit\Component
{

    public function setLabel($label)
    {
        $this->setAttribute("label", $label);
    }
}

$schema = new FormKit\Schema();
$schema->registerClass("q-btn", QBtn::class);
$node=$schema->appendHTML("<q-btn label='Hello'/>")[0]; //$node=$schema->appendComponent("q-btn");

//change label
$node->setLabel("World");

echo json_encode($schema, JSON_PRETTY_PRINT);

```

output:

```json
[
    {
        "$cmp": "q-btn",
        "props": {
            "label": "World"
        }
    }
]
```


### Append child nodes

```php
$schema = new FormKit\Schema();
$e = $schema->appendHTML("<div></div>")[0];
$e->append($schema->createElement("div", "hello"));
echo json_encode($schema, JSON_PRETTY_PRINT);

```

output:

```json
[
    {
        "$el": "div",
        "children": [
            {
                "$el": "div",
                "children": [
                    "hello"
                ]
            }
        ]
    }
]
```

### Append child nodes from HTML

```php
$schema = new FormKit\Schema();
$e = $schema->appendHTML("<div></div>")[0];
$e->appendHTML("<div>hello</div>");
echo json_encode($schema, JSON_PRETTY_PRINT);

```

output:

```json
[
    {
        "$el": "div",
        "children": [
            {
                "$el": "div",
                "children": [
                    "hello"
                ]
            }
        ]
    }
]
```


### Loops

```php

$group = $schema->appendHTML("<form-kit type='group'/>")[0];
$group->setAttribute(":value", json_encode([
    "cities" => ["Hong Kong", "Taiwan", "China"]
]));

$div = $group->appendElement("div");

$div->for(["item", "key", '$value.cities']);

$div->appendHTML('$item');

echo json_encode($schema, JSON_PRETTY_PRINT);

```

output:

```json
[
    {
        "$formkit": "group",
        "value": {
            "cities": [
                "Hong Kong",
                "Taiwan",
                "China"
            ]
        },
        "children": [
            {
                "$el": "div",
                "v-for": [
                    "item",
                    "key",
                    "$value.cities"
                ],
                "children": [
                    "$item"
                ]
            }
        ]
    }
]
```

    