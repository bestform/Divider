DIVIDER
-------

![Travis Build Status](https://api.travis-ci.org/bestform/Divider.svg?branch=master)

The `Divider` class can be used to divide a certain amount into smaller parts, that can be defined.

You can use it for example to divide an amount of money into possible coins and notes. The default parts when instantiating a `Divider` instance are all possible € coins and notes.

Example:

```php
<?php

$divider = new Divider();
$result = $divider->divide(30); // [20 => 1, 10 => 1]
```

The class only handles integers, so if you are working with € keep in mind that the input as well as output is considered being cents.

`Divider` also handles rest values:

```php
<?php

$divider = new Divider([3]);
$result = $divider->divide(4); // [3=>1, "REST" => 1]
```


