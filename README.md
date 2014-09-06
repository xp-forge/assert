Assertions for the XP Framework
===============================

[![Build Status on TravisCI](https://secure.travis-ci.org/xp-forge/assert.svg)](http://travis-ci.org/xp-forge/assert)
[![XP Framework Mdodule](https://raw.githubusercontent.com/xp-framework/web/master/static/xp-framework-badge.png)](https://github.com/xp-framework/core)
[![BSD Licence](https://raw.githubusercontent.com/xp-framework/web/master/static/licence-bsd.png)](https://github.com/xp-framework/core/blob/master/LICENCE.md)
[![Required PHP 5.4+](https://raw.githubusercontent.com/xp-framework/web/master/static/php-5_4plus.png)](http://php.net/)

Flexible assertions on top of the XP Framwork's unittest package.

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