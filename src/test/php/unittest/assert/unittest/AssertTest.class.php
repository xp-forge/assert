<?php namespace unittest\assert\unittest;

use unittest\assert\Assert;
use unittest\assert\All;
use unittest\AssertionFailedError;

class AssertTest extends \unittest\TestCase {

  #[@test]
  public function succeeds() {
    Assert::that(1)->isEqualTo(1);
  }

  #[@test]
  public function fails() {
    try {
      Assert::that(1)->isEqualTo(0);
    } catch (AssertionFailedError $expected) {
      return;
    }
    $this->fail('Must have raised an exception', null, 'unittest.AssertionFailedError');
  }

  #[@test]
  public function fails_in_chained() {
    try {
      Assert::that('Hello')->contains('e')->isEmpty();
    } catch (AssertionFailedError $expected) {
      return;
    }
    $this->fail('Must have raised an exception', null, 'unittest.AssertionFailedError');
  }

  #[@test]
  public function execute_all_assertions() {
    try {
      All::of(function() {
        Assert::that('Hello')->contains('e');
        Assert::that('')->isEmpty();
        Assert::that('Test')->startsWith('not');
        Assert::that('e')->isEmpty();
      });
    } catch (AssertionFailedError $expected) {
      return;
    }
    $this->fail('Must have raised an exception', null, 'unittest.AssertionFailedError');
  }
}