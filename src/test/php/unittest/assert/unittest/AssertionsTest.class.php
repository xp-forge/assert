<?php namespace unittest\assert\unittest;

use unittest\assert\Assert;
use unittest\assert\Assertions;
use lang\Object;
use lang\types\String;

#[@action(new Assertions())]
class AssertionsTest extends AbstractAssertionsTest {

  #[@test, @values('fixtures')]
  public function fixtures_are_equal_to_itself_via_isEqualTo($value) {
    Assert::that($value)->isEqualTo($value);
  }

  #[@test, @expect('unittest.AssertionFailedError'), @values('fixtures')]
  public function fixtures_are_not_equal_to_new_object_via_isEqualTo($value) {
    Assert::that($value)->isEqualTo(new Object());
  }

  #[@test, @values('fixtures')]
  public function fixtures_are_not_equal_to_new_object_via_isNotEqualTo($value) {
    Assert::that($value)->isNotEqualTo(new Object());
  }

  #[@test, @expect('unittest.AssertionFailedError'), @values('fixtures')]
  public function fixtures_are_equal_to_itself_via_isNotEqualTo($value) {
    Assert::that($value)->isNotEqualTo($value);
  }

  #[@test, @values('fixtures')]
  public function is_in_an_array_of_itself($value) {
    Assert::that($value)->isIn([$value]);
  }

  #[@test, @values('fixtures')]
  public function is_in_an_array_of_itself_and_an_object($value) {
    Assert::that($value)->isIn([new Object(), $value]);
  }

  #[@test, @expect('unittest.AssertionFailedError'), @values('fixtures')]
  public function is_not_in_an_empty_array($value) {
    Assert::that($value)->isIn([]);
  }

  #[@test, @expect('unittest.AssertionFailedError'), @values('fixtures')]
  public function is_in_an_array_of_itself_via_isNotIn($value) {
    Assert::that($value)->isNotIn([$value]);
  }

  #[@test, @expect('unittest.AssertionFailedError'), @values('fixtures')]
  public function is_in_an_array_of_itself_and_an_object_via_isNotIn($value) {
    Assert::that($value)->isNotIn([new Object(), $value]);
  }

  #[@test, @values('fixtures')]
  public function is_not_in_an_empty_array_via_isNotIn($value) {
    Assert::that($value)->isNotIn([]);
  }

  #[@test]
  public function null_is_null() {
    Assert::that(null)->isNull();
  }

  #[@test, @expect('unittest.AssertionFailedError'), @values(source= 'fixtures', args= [[null]])]
  public function all_other_values_are_not_null($value) {
    Assert::that($value)->isNull();
  }

  #[@test]
  public function true_is_true() {
    Assert::that(true)->isTrue();
  }

  #[@test, @expect('unittest.AssertionFailedError'), @values(source= 'fixtures', args= [[true]])]
  public function all_other_values_are_not_true($value) {
    Assert::that($value)->isTrue();
  }

  #[@test]
  public function false_is_false() {
    Assert::that(false)->isFalse();
  }

  #[@test, @expect('unittest.AssertionFailedError'), @values(source= 'fixtures', args= [[false]])]
  public function all_other_values_are_not_false($value) {
    Assert::that($value)->isFalse();
  }
}