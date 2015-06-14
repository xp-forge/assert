<?php namespace unittest\assert\unittest;

use unittest\assert\Assertions;

class NumberAssertionsTest extends TypeAssertionsTest {

  /** @return var[][] */
  protected function typeFixtures() { return [[0], [0.0], [1], [1.0]]; }

  /** @return var[][] */
  protected function lessThan1() { return [[0, -1, 0.0, 0.99999, PHP_INT_MIN]]; }

  /** @return var[][] */
  protected function moreThan1() { return [[2, 1.00001, PHP_INT_MAX]]; }

  #[@test, @values('moreThan1')]
  public function isGreaterThan1($value) {
    $this->assertVerified(Assertions::of($value)->isGreaterThan(1));
  }

  #[@test, @values('lessThan1')]
  public function is_not_LargerThan1($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is greater than 1/'],
      Assertions::of($value)->isGreaterThan(1)
    );
  }

  #[@test, @values('lessThan1')]
  public function isLessThan1($value) {
    $this->assertVerified(Assertions::of($value)->isLessThan(1));
  }

  #[@test, @values('moreThan1')]
  public function is_not_LessThan1($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is less than 1/'],
      Assertions::of($value)->isLessThan(1)
    );
  }

  #[@test, @values([1, 1.0, 1.00001, 1.99999, 2])]
  public function isBetween_1_and_2($value) {
    $this->assertVerified(Assertions::of($value)->isBetween(1, 2));
  }

  #[@test, @values('lessThan1')]
  public function values_less_than_1_are_notBetween_1_and_2($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is between 1 and 2/'],
      Assertions::of($value)->isBetween(1, 2)
    );
  }

  #[@test, @values('moreThan1')]
  public function values_more_than_1_are_notBetween_0_and_1($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is between 0 and 1/'],
      Assertions::of($value)->isBetween(0, 1)
    );
  }

  #[@test, @values([1.0, 1.00001, 0.99999])]
  public function isCloseTo1_using_decimals($value) {
    $this->assertVerified(Assertions::of($value)->isCloseTo(1, 0.001));
  }

  #[@test, @values([1, 0, 2])]
  public function isCloseTo1_using_integers($value) {
    $this->assertVerified(Assertions::of($value)->isCloseTo(1, 1));
  }

  #[@test, @values([-1, 3])]
  public function is_not_CloseTo1_using_integers($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is close to 1 \(within a tolerance of 1\)/'],
      Assertions::of($value)->isCloseTo(1, 1)
    );
  }
}