<?php namespace unittest\assert\unittest;

use unittest\assert\Assertions;
use unittest\{Test, Values};

class AssertionsTest extends AbstractAssertionsTest {

  #[Test, Values('fixtures')]
  public function fixtures_are_equal_to_itself_via_isEqualTo($value) {
    $this->assertVerified(Assertions::of($value)->isEqualTo($value));
  }

  #[Test, Values('fixtures')]
  public function fixtures_are_not_equal_to_new_object_via_isEqualTo($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is equal to unittest.assert.unittest.Name .+/ms'],
      Assertions::of($value)->isEqualTo(new Name('Test'))
    );
  }

  #[Test, Values('fixtures')]
  public function fixtures_are_not_equal_to_new_object_via_isNotEqualTo($value) {
    $this->assertVerified(Assertions::of($value)->isNotEqualTo(new Name('Test')));
  }

  #[Test, Values('fixtures')]
  public function fixtures_are_equal_to_itself_via_isNotEqualTo($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is not equal to .*/ms'],
      Assertions::of($value)->isNotEqualTo($value)
    );
  }

  #[Test, Values('fixtures')]
  public function is_in_an_array_of_itself($value) {
    $this->assertVerified(Assertions::of($value)->isIn([$value]));
  }

  #[Test, Values('fixtures')]
  public function is_in_an_array_of_itself_and_an_object($value) {
    $this->assertVerified(Assertions::of($value)->isIn([new Name('Test'), $value]));
  }

  #[Test, Values('fixtures')]
  public function is_not_in_an_empty_array($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is contained in .*/ms'],
      Assertions::of($value)->isIn([])
    );
  }

  #[Test, Values('fixtures')]
  public function is_in_an_array_of_itself_via_isNotIn($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is not contained in .*/ms'],
      Assertions::of($value)->isNotIn([$value])
    );
  }

  #[Test, Values('fixtures')]
  public function is_in_an_array_of_itself_and_an_object_via_isNotIn($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is not contained in .*/ms'],
      Assertions::of($value)->isNotIn([new Name('Test'), $value])
    );
  }

  #[Test, Values('fixtures')]
  public function is_not_in_an_empty_array_via_isNotIn($value) {
    $this->assertVerified(Assertions::of($value)->isNotIn([]));
  }

  #[Test]
  public function null_is_null() {
    $this->assertVerified(Assertions::of(null)->isNull());
  }

  #[Test, Values(['source' => 'fixtures', 'args' => [[null]]])]
  public function all_other_values_are_not_null($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is null/ms'],
      Assertions::of($value)->isNull()
    );
  }

  #[Test]
  public function true_is_true() {
    $this->assertVerified(Assertions::of(true)->isTrue());
  }

  #[Test, Values(['source' => 'fixtures', 'args' => [[true]]])]
  public function all_other_values_are_not_true($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is true/ms'],
      Assertions::of($value)->isTrue()
    );
  }

  #[Test]
  public function false_is_false() {
    $this->assertVerified(Assertions::of(false)->isFalse());
  }

  #[Test, Values(['source' => 'fixtures', 'args' => [[false]]])]
  public function all_other_values_are_not_false($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is false/ms'],
      Assertions::of($value)->isFalse()
    );
  }
}