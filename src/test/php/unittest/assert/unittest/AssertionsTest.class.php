<?php namespace unittest\assert\unittest;

use unittest\assert\Value;
use lang\Object;
use lang\types\String;

class AssertionsTest extends AbstractAssertionsTest {

  #[@test, @values('fixtures')]
  public function fixtures_are_equal_to_itself_via_isEqualTo($value) {
    $this->assertVerified(Value::of($value)->isEqualTo($value));
  }

  #[@test, @values('fixtures')]
  public function fixtures_are_not_equal_to_new_object_via_isEqualTo($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is equal to lang.Object .+/ms'],
      Value::of($value)->isEqualTo(new Object())
    );
  }

  #[@test, @values('fixtures')]
  public function fixtures_are_not_equal_to_new_object_via_isNotEqualTo($value) {
    $this->assertVerified(Value::of($value)->isNotEqualTo(new Object()));
  }

  #[@test, @values('fixtures')]
  public function fixtures_are_equal_to_itself_via_isNotEqualTo($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is not equal to .*/ms'],
      Value::of($value)->isNotEqualTo($value)
    );
  }

  #[@test, @values('fixtures')]
  public function is_in_an_array_of_itself($value) {
    $this->assertVerified(Value::of($value)->isIn([$value]));
  }

  #[@test, @values('fixtures')]
  public function is_in_an_array_of_itself_and_an_object($value) {
    $this->assertVerified(Value::of($value)->isIn([new Object(), $value]));
  }

  #[@test, @values('fixtures')]
  public function is_not_in_an_empty_array($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is contained in .*/ms'],
      Value::of($value)->isIn([])
    );
  }

  #[@test, @values('fixtures')]
  public function is_in_an_array_of_itself_via_isNotIn($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is not contained in .*/ms'],
      Value::of($value)->isNotIn([$value])
    );
  }

  #[@test, @values('fixtures')]
  public function is_in_an_array_of_itself_and_an_object_via_isNotIn($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is not contained in .*/ms'],
      Value::of($value)->isNotIn([new Object(), $value])
    );
  }

  #[@test, @values('fixtures')]
  public function is_not_in_an_empty_array_via_isNotIn($value) {
    $this->assertVerified(Value::of($value)->isNotIn([]));
  }

  #[@test]
  public function null_is_null() {
    $this->assertVerified(Value::of(null)->isNull());
  }

  #[@test, @values(source= 'fixtures', args= [[null]])]
  public function all_other_values_are_not_null($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is null/ms'],
      Value::of($value)->isNull()
    );
  }

  #[@test]
  public function true_is_true() {
    $this->assertVerified(Value::of(true)->isTrue());
  }

  #[@test, @values(source= 'fixtures', args= [[true]])]
  public function all_other_values_are_not_true($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is true/ms'],
      Value::of($value)->isTrue()
    );
  }

  #[@test]
  public function false_is_false() {
    $this->assertVerified(Value::of(false)->isFalse());
  }

  #[@test, @values(source= 'fixtures', args= [[false]])]
  public function all_other_values_are_not_false($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is false/ms'],
      Value::of($value)->isFalse()
    );
  }
}