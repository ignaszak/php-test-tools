# ignaszak/testing-tools
---
This package provides tools for testing class via reflection.

# Requirements

* PHP >= 7.0.0
* PHPUnit = 5.*

# Installation

```
composer require ignaszak/testing-tools
```

# Usage

## Get property value

```php
<?php

use Ignaszak\TestingTools\Test;

Test::get('propertyName', $object);
```

## Set property value

```php
<?php

use Ignaszak\TestingTools\Test;

// Set value
Test::inject('propertyName', 'new value', $object);
// Get value
Test::get('propertyName', $object);
```

## Call method

```php
<?php

use Ignaszak\TestingTools\Test;

// Call method with args
Test::call('method', ['arg1', 'arg2'], $object);
// Call method wthout args
Test::call('method', null, $object);
```

## Define tested class

You can set instance of tested class in ```Test::$object```.

```php
<?php

use Ignaszak\TestingTools\Test;

Test::$object = new Example();

// All these methods refers to `Example`
Test::inject('propertyName', 'new value');
Test::inject('propertyName'); // Set null
Test::get('propertyName');
Test::call('method');
Test::call('method', ['arg1', 'arg2']);
```
