<?php namespace unittest\assert\unittest;

use unittest\assert\Value;

abstract class TypeAssertionsTest extends AbstractAssertionsTest {

  /** @return var[][] */
  protected abstract function typeFixtures();

  /** @return var[][] */
  protected function otherFixtures() {
    $return= [];
    foreach ($this->typeFixtures() as $fixture) {
      foreach ($this->fixtures($fixture) as $value) {
        $return[]= [$fixture[0], $value[0]];
      }
    }
    return $return;
  }

  #[@test, @values('typeFixtures')]
  public function is_not_null($fixture) {
    $this->assertUnverified(
      ['/Failed to verify that .* is null/ms'],
      Value::of($fixture)->isNull()
    );
  }

  #[@test, @values('typeFixtures')]
  public function is_not_true($fixture) {
    $this->assertUnverified(
      ['/Failed to verify that .* is true/ms'],
      Value::of($fixture)->isTrue()
    );
  }

  #[@test, @values('typeFixtures')]
  public function is_not_false($fixture) {
    $this->assertUnverified(
      ['/Failed to verify that .* is false/ms'],
      Value::of($fixture)->isFalse()
    );
  }

  #[@test, @values('otherFixtures')]
  public function is_not_equal_to_other_fixtures($fixture, $value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is equal to .*/ms'],
      Value::of($fixture)->isEqualTo($value)
    );
  }
}