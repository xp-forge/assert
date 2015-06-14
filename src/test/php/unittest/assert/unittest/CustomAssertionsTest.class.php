<?php namespace unittest\assert\unittest;

use unittest\assert\Value;
use unittest\assert\Assertions;
new import('unittest.assert.unittest.TestCaseAssertions');

#[@action(new Assertions())]
class CustomAssertionsTest extends AbstractAssertionsTest {

  #[@test]
  public function hasName() {
    $this->assertVerified(Value::of($this)->hasName($this->name));
  }

  #[@test]
  public function isIgnored() {
    $this->assertUnverified(
      ['/Failed to verify that .* is ignored/'],
      Value::of($this)->isIgnored()
    );
  }
}