Assertions for the XP Framework
===============================

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