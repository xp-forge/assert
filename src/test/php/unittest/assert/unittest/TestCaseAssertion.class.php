<?php namespace unittest\assert\unittest;

use unittest\assert\Value;

class TestCaseAssertion extends \unittest\assert\Assertion {
  
  public static function hasName(Value $self, $name) {
    return $self->isInstanceOf('unittest.TestCase')->extracting('name')->isEqualTo($name);
  }
}