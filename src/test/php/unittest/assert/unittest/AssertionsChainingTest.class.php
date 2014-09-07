<?php namespace unittest\assert\unittest;

use unittest\assert\Value;

class AssertionsChainingTest extends AbstractAssertionsTest {

  #[@test]
  public function startsWith_and_endsWith() {
    $this->assertVerified(Value::of('www.example.com')->startsWith('www')->endsWith('com'));
  }

  #[@test]
  public function array_size_and_elements() {
    $this->assertVerified(Value::of([1, 2, 3])->isNotEqualTo(null)->hasSize(3)->contains(2));
  }
}