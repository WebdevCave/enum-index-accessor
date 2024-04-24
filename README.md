# enum-index-accessor

## Install with composer:

```
composer install webdevcave/enum-index-accessor
```

## Why?

From php 8.1 or newer, the possibility organized enumerators was made real.
It works just fine until we have to read those values dynamically. Here is an example:

```php
enum HexColors: string {
    case RED = '#FF0000';
    case GREEN = '#00FF00';
    case BLUE = '#0000FF';
    case WHITE = '#FFFFFF';
    case BLACK = '#000000';
    // and so on...
}

$index = 'BLUE'; // Imagine this is a dynamic value
$constant = HexColors::class."::$index"; // In a real-world application HexColors
                                         // will most probably be declared under a namespace
$color = null;

// Before we proceed, we have to ensure the specified index exists or our code will break
if (defined($constant)) {
    $color = constant($constant)->value; // Now we read its value
}

// You will probably want to assign a default value in case something went wrong
if (is_null($color)) {
    $color = HexColors::RED->value;
}

// Now we can finally proceed with our task...
```

Does this looks too verbose and/or messy for your taste? Now imagine if your application have to read multiple values
like this.

That's why we created this package! Now you can do the same task this way:

```php
$color = HexColors::tryValue($index) ?? HexColors::value('RED');
```

How?

```php
use \WebdevCave\EnumIndexAccessor\BackedEnumIndexAccessor; // step 1: Import the trait

enum HexColors: string {
    case RED = '#FF0000';
    case GREEN = '#00FF00';
    case BLUE = '#0000FF';
    case WHITE = '#FFFFFF';
    case BLACK = '#000000';
    // and so on...
    
    use BackedEnumIndexAccessor; // step 2: use it
}
```

~ And voila! Magic 🪄! 

---

## Other use cases...

We followed the php team standards for naming the methods for ease of use. Here is a list of all of them:

```php
HexColors::hasIndex($index); // Checks if a case statement was set in the enumerator (boolean)
HexColors::index($index); // Read the object from given index (skips index check)
HexColors::tryIndex($index); // Read the object from given index (null on non-existent)
HexColors::value($index); // Read the value from given index (skips index check)
HexColors::tryValue($index); // Read the value from given index (null on non-existent)
```

For pure enumerators (without backing values), use the pure enumerator trait as follows:

```php
use \WebdevCave\EnumIndexAccessor\PureEnumIndexAccessor; // step 1: Import the trait

enum Fruits {
    case ORANGE;
    case PEAR;
    case APPLE;
    // and so on...
    
    use PureEnumIndexAccessor; // step 2: use it
}
```

**Important note:** The methods `value` and `tryValue` are not available as pure enumerators doesn't carry any values on them
