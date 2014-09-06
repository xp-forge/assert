<?php namespace unittest\assert\unittest;

use unittest\assert\Assert;
use unittest\assert\Assertions;

#[@action(new Assertions())]
class AssertionsChainingTest extends AbstractAssertionsTest {

  #[@test]
  public function startsWith_and_endsWith() {
    Assert::that('www.example.com')->startsWith('www')->endsWith('com');
  }

  #[@test]
  public function array_size_and_elements() {
    Assert::that([1, 2, 3])->isNotEqualTo(null)->hasSize(3)->contains(2);
  }
}