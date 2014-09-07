<?php namespace unittest\assert\unittest;

use unittest\assert\Assert;
use unittest\assert\Assertions;

#[@action(new Assertions())]
class ConditionAssertionsTest extends AbstractAssertionsTest {

  #[@test]
  public function is_a_test() {
    Assert::that('Test')->is(newinstance('unittest.assert.Condition', [], [
      'matches' => function($value) { return 'Test' === $value; }
    ]));
  }

  #[@test]
  public function is_not_a_test() {
    Assert::that('Test')->isNot(newinstance('unittest.assert.Condition', [], [
      'matches' => function($value) { return 'Test' !== $value; }
    ]));
  }
}