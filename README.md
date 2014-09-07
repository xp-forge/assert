Assertions for the XP Framework
===============================

[![Build Status on TravisCI](https://secure.travis-ci.org/xp-forge/assert.svg)](http://travis-ci.org/xp-forge/assert)
[![XP Framework Mdodule](https://raw.githubusercontent.com/xp-framework/web/master/static/xp-framework-badge.png)](https://github.com/xp-framework/core)
[![BSD Licence](https://raw.githubusercontent.com/xp-framework/web/master/static/licence-bsd.png)](https://github.com/xp-framework/core/blob/master/LICENCE.md)
[![Required PHP 5.4+](https://raw.githubusercontent.com/xp-framework/web/master/static/php-5_4plus.png)](http://php.net/)

Flexible assertions on top of the XP Framwork's unittest package.

Example
-------

```php
use unittest\assert\Assert;
use unittest\assert\Assertions;

#[@action(new Assertions())]
class ExampleTest extends AbstractAssertionsTest {

  #[@test]
  public function example() {
    $people= ...;
    Assert::that($people)->hasSize(1)->contains('The Dude');
  }
}
```

Assertions
----------
Generic assertions:

* `is(Condition $condition)` - Asserts a given condition matches
* `isNot(Condition $condition)` - Asserts a given condition does not match
* `isEqualTo(var $compare)` - Asserts the value is equal to a given comparison
* `isNotEqualTo(var $compare)` - Asserts the value is not equal to a given comparison
* `isNull()` - Asserts the value is null
* `isTrue()` - Asserts the value is true
* `isFalse()` - Asserts the value is false
* `isIn(var $enumerable)` - Asserts the value is in a given enumerable 
* `isNotIn(var $enumerable)` - Asserts the value is not in a given enumerable
* `isInstanceOf(var $type)` - Asserts the value is of a given type

With special meanings dependant on type:

* `hasSize(int $size)` - Asserts a string length, array or map size
* `startsWith(var $element)` - Asserts a string or array contains the given element at its start
* `endsWith(var $element)` - Asserts a string or array contains the given element at its end
* `contains(var $element)` - Asserts a string, array or map contains a given element
* `doesNotContain(var $element)` - Asserts a string, array or map does not contain a given element
