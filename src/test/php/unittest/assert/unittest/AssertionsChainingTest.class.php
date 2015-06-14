<?php namespace unittest\assert\unittest;

use unittest\assert\Assertions;

class AssertionsChainingTest extends AbstractAssertionsTest {

  #[@test]
  public function startsWith_and_endsWith() {
    $this->assertVerified(Assertions::of('www.example.com')->startsWith('www')->endsWith('com'));
  }

  #[@test]
  public function array_size_and_elements() {
    $this->assertVerified(Assertions::of([1, 2, 3])->isNotEqualTo(null)->hasSize(3)->contains(2));
  }
}