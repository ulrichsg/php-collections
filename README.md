Collections Library for PHP
===========================

PHP's arrays are a jack-of-all-trades data structure - highly flexible, but there are numerous use cases where I
would rather have more specific functionality like the one offered by Java's Collection API. Since PHP 5, the
[Standard PHP Library](http://php.net/manual/en/book.spl.php) offers classes that cover some of these cases, but not
nearly all. This project is an attempt to add more.

What? Why?
----------

Imagine the following bit of code that aggregates values, indexed by type:
```php
$totals = array();
foreach ($items as $item) {
	if (!isset($totals[$item->type])) {
		$totals[$item->type] = 0;
	}
	$totals[$item->type] += $item->value;
}
```
The `if (!isset(...))` block makes this piece of code rather ugly, but it is necessary to avoid even uglier warnings.
Using the `NumberMap` class from this package we can avoid it and just write:
```php
$totals = new NumberMap();
foreach ($items as $item) {
	$totals->add($item->type, $item->value);
}
```

Collection types
----------------

So far the package only provides two collection types:
* `Map` - basic key-value map
* `NumberMap` - a map that can do some math on its entries (see the example above)

I'd love to have more, so send me your ideas - or your pull requests :)

Common features
---------------

For maximum convenience, all classes in this package implement the following interfaces:
* [ArrayAccess](http://php.net/manual/en/class.arrayaccess.php) - square-bracket syntax
* [IteratorAggregate](http://php.net/manual/en/class.iteratoraggregate.php) - foreach loops
* [Countable](http://www.php.net/manual/en/class.countable.php) - count() support


Installation
------------

* As a project dependency: Just add `ulrichsg/php-collections` to your composer.json.
* Stand-alone for hacking: Clone this repository and run `make` to see a few handy commands.

API documentation
-----------------

[Go here](http://ulrichsg.github.io/php-collections/doc) for PHPDoc-generated documentation.

License
-------

This package is released under the [MIT license](http://opensource.org/licenses/MIT).
