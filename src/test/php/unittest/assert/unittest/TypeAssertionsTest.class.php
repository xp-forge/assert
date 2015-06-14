<?php namespace unittest\assert\unittest;

use unittest\assert\Assertions;

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
    if (null !== $fixture) $this->assertUnverified(
      ['/Failed to verify that .* is null/ms'],
      Assertions::of($fixture)->isNull()
    );
  }

  #[@test, @values('typeFixtures')]
  public function is_not_true($fixture) {
    if (true !== $fixture) $this->assertUnverified(
      ['/Failed to verify that .* is true/ms'],
      Assertions::of($fixture)->isTrue()
    );
  }

  #[@test, @values('typeFixtures')]
  public function is_not_false($fixture) {
    if (false !== $fixture) $this->assertUnverified(
      ['/Failed to verify that .* is false/ms'],
      Assertions::of($fixture)->isFalse()
    );
  }

  #[@test, @values('otherFixtures')]
  public function is_not_equal_to_other_fixtures($fixture, $value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is equal to .*/ms'],
      Assertions::of($fixture)->isEqualTo($value)
    );
  }
}