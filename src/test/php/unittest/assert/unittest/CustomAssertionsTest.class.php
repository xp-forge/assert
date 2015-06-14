<?php namespace unittest\assert\unittest;

use unittest\assert\Value;
new import('unittest.assert.unittest.TestCaseAssertion');

class CustomAssertionsTest extends AbstractAssertionsTest {

  #[@test]
  public function hasName() {
    $this->assertVerified(Value::of($this)->hasName($this->name));
  }
}