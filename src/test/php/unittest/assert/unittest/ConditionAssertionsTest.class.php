<?php namespace unittest\assert\unittest;

use unittest\assert\Assertions;

/**
 * Tests `is()` and `isNot()` methods which accept unittest.assert.Condition instances
 */
class ConditionAssertionsTest extends AbstractAssertionsTest {

  #[@test]
  public function is_a_test() {
    $this->assertVerified(Assertions::of('Test')->is(newinstance('unittest.assert.Condition', [], [
      'matches' => function($value) { return 'Test' === $value; }
    ])));
  }

  #[@test]
  public function is_not_a_test() {
    $this->assertVerified(Assertions::of('Test')->isNot(newinstance('unittest.assert.Condition', [], [
      'matches' => function($value) { return 'Test' !== $value; }
    ])));
  }
}