<?php namespace unittest\assert\unittest;

use unittest\Test;
use unittest\assert\{Assertions, Condition};

/**
 * Tests `is()` and `isNot()` methods which accept unittest.assert.Condition instances
 */
class ConditionAssertionsTest extends AbstractAssertionsTest {

  #[Test]
  public function is_a_test() {
    $this->assertVerified(Assertions::of('Test')->is(new class() extends Condition {
      public function matches($value) { return 'Test' === $value; }
    }));
  }

  #[Test]
  public function is_not_a_test() {
    $this->assertVerified(Assertions::of('Test')->isNot(new class() extends Condition {
      public function matches($value) { return 'Test' !== $value; }
    }));
  }
}