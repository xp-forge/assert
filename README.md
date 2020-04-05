Assertions
==========

[![Build Status on TravisCI](https://secure.travis-ci.org/xp-forge/assert.svg)](http://travis-ci.org/xp-forge/assert)
[![XP Framework Mdodule](https://raw.githubusercontent.com/xp-framework/web/master/static/xp-framework-badge.png)](https://github.com/xp-framework/core)
[![BSD Licence](https://raw.githubusercontent.com/xp-framework/web/master/static/licence-bsd.png)](https://github.com/xp-framework/core/blob/master/LICENCE.md)
[![Required PHP 5.6+](https://raw.githubusercontent.com/xp-framework/web/master/static/php-5_6plus.png)](http://php.net/)
[![Supports PHP 7.0+](https://raw.githubusercontent.com/xp-framework/web/master/static/php-7_0plus.png)](http://php.net/)
[![Latest Stable Version](https://poser.pugx.org/xp-forge/assert/version.png)](https://packagist.org/packages/xp-forge/assert)

Flexible assertions on top of the XP Framework's unittest package.

Example
-------

```php
use unittest\assert\{Assert, All};

class ExampleTest {

  #[@test]
  public function succeeds() {
    Assert::that(['The Dude'])->hasSize(1)->contains('The Dude');
  }

  #[@test]
  public function fails() {
    All::of(function() { 
      Assert::that('localhost')->startsWith('www');
      Assert::that('example.com')->endsWith('.org');
    });
  }
}
```

Running this test will yield one succeeded and one failed test. The difference to regular unittest messages is the more readable format. 

On top of that, this library's assertions are also more flexible: As seen in the above case, we wrapped the chain in an `All::of()` call which will yield *all* failed assertions, not just the first one.

```sh
$ xp test ExampleTest.class.php
[.F]

F unittest.TestAssertionFailed(test= ExampleTest::fails, time= 0.002 seconds) {
  unittest.AssertionFailedError{ The following 2 assertions have failures:
    1: unittest.AssertionFailedError{ Failed to verify that "localhost" starts with "www" }
    2: unittest.AssertionFailedError{ Failed to verify that "example.com" ends with ".org" }
   }
    at unittest.assert.All::of() [line 17 of ExampleTest.class.php]
    at ExampleTest::fails() [line 0 of StackTraceElement.class.php]
    at ReflectionMethod::invokeArgs() [line 90 of Method.class.php]
    at lang.reflect.Method::invoke() [line 334 of TestSuite.class.php]
    at unittest.TestSuite::runInternal() [line 565 of TestSuite.class.php]
    at unittest.TestSuite::run() [line 369 of Runner.class.php]
    at xp.unittest.Runner::run() [line 380 of Runner.class.php]
    at xp.unittest.Runner::main() [line 281 of class-main.php]

 }

✗: 2/2 run (0 skipped), 1 succeeded, 1 failed
Memory used: 1610.91 kB (1710.45 kB peak)
Time taken: 0.005 seconds
````

Assertions
----------
Generic assertions:

* `is(unittest.assert.Condition $condition)` - Asserts a given condition matches
* `isNot(unittest.assert.Condition $condition)` - Asserts a given condition does not match
* `isEqualTo(var $compare)` - Asserts the value is equal to a given comparison
* `isNotEqualTo(var $compare)` - Asserts the value is not equal to a given comparison
* `isNull()` - Asserts the value is null
* `isTrue()` - Asserts the value is true
* `isFalse()` - Asserts the value is false
* `isIn(var $enumerable)` - Asserts the value is in a given enumerable 
* `isNotIn(var $enumerable)` - Asserts the value is not in a given enumerable
* `isInstanceOf(string|lang.Type $type)` - Asserts the value is of a given type

With special meanings dependant on type:

* `isEmpty()` - Asserts a string, array or map is empty
* `hasSize(int $size)` - Asserts a string length, array or map size
* `startsWith(var $element)` - Asserts a string or array contains the given element at its start
* `endsWith(var $element)` - Asserts a string or array contains the given element at its end
* `contains(var $element)` - Asserts a string, array or map contains a given element
* `doesNotContain(var $element)` - Asserts a string, array or map does not contain a given element

For numbers:

* `isGreaterThan(int|double $comparison)` - Asserts *value > comparison*
* `isLessThan(int|double $comparison)` - Asserts *value < comparison*
* `isBetween(int|double $start, int|double $end)` - Asserts *value >= start && value <= end*
* `isCloseTo(int|double $comparison, int|double $tolerance)` - Asserts value is close (defined per tolerance)

Transformations
---------------
Values can be transformed prior to invoking assertions on them.

Extraction works directly on instances (using properties and `get`-prefixed as well as plain getters):

```php
$tim= new Person(6100, 'Tim Tailor');
Assert::that($tim)->extracting('name')->isEqualTo('Tim Tailor');
```

You can also pass a closure to control more precisely what's extracted:

```php
$tim= new Person(6100, 'Tim Tailor');
Assert::that($tim)->extracting(function($p) { return $p->name(); })->isEqualTo('Tim Tailor');
```

For maps, extraction accesses the elements by their string keys:

```php
$person= ['id' => 6100, 'name' => 'Test', 'age' => 42];
Assert::that($person)->extracting('age')->isEqualTo(42);
```

Passing an array to `extracting()` will extract multiple elements and return them in an array in the order they're passed:

```php
$person= ['id' => 6100, 'name' => 'Test', 'age' => 42];
Assert::that($person)->extracting(['name', 'age'])->isEqualTo(['Test', 42]);
```

Passing maps to `extracting()` will extract multiple elements and return them in a map.

```php
$person= ['id' => 6100, 'name' => 'Test', 'age' => 42];
Assert::that($person)->extracting(['identifier' => 'id'])->isEqualTo(['identifier' => 6100]);
```

For arrays, the `extracting()` method applies the extraction on every element:

```php
$people= [new Person(1, 'Queen'), new Person(2, 'King')];
Assert::that($people)->extracting('name')->isEqualTo(['Queen', 'King']);
```
