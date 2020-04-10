<?php namespace unittest\assert\unittest;

use lang\IllegalStateException;
use unittest\AssertionFailedError;
use unittest\assert\{All, Assert, Condition};

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

  #[@test]
  public function even_inside_allof_execution_stops_at_first_failure() {
    try {
      All::of(function() {
        Assert::that('Hello')->isEmpty()->is(new class() extends Condition {
          public function matches($value) { throw new IllegalStateException('Unreachable'); }
        });
      });
    } catch (AssertionFailedError $expected) {
      return;
    }
    $this->fail('Must have raised an exception', null, 'unittest.AssertionFailedError');
  }
}