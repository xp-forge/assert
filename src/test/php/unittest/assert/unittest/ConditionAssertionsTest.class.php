<?php namespace unittest\assert\unittest;

use unittest\assert\Value;

/**
 * Tests `is()` and `isNot()` methods which accept unittest.assert.Condition instances
 */
class ConditionAssertionsTest extends AbstractAssertionsTest {

  #[@test]
  public function is_a_test() {
    $this->assertVerified(Value::of('Test')->is(newinstance('unittest.assert.Condition', [], [
      'matches' => function($value) { return 'Test' === $value; }
    ])));
  }

  #[@test]
  public function is_not_a_test() {
    $this->assertVerified(Value::of('Test')->isNot(newinstance('unittest.assert.Condition', [], [
      'matches' => function($value) { return 'Test' !== $value; }
    ])));
  }
}