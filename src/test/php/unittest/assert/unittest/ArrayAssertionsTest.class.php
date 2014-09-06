<?php namespace unittest\assert\unittest;

use unittest\assert\Assert;
use unittest\assert\Assertions;
use lang\Object;
use lang\types\ArrayList;

#[@action(new Assertions())]
class ArrayAssertionsTest extends AbstractAssertionsTest {

  #[@test, @values([[[]], [[1]], [[1, 2]]])]
  public function array_has_size($value) {
    Assert::that($value)->hasSize(sizeof($value));
  }

  #[@test, @values([[[]], [[1]], [[1, 2]]])]
  public function arrayList_has_size($value) {
    Assert::that(ArrayList::newInstance($value))->hasSize(sizeof($value));
  }

  #[@test, @values('fixtures')]
  public function an_array_of_the_fixture_value_contains_the_value($value) {
    Assert::that([$value])->contains($value);
  }

  #[@test, @values('fixtures')]
  public function an_array_of_the_fixture_value_and_an_object_contains_the_value($value) {
    Assert::that([new Object(), $value])->contains($value);
  }

  #[@test, @expect('unittest.AssertionFailedError'), @values('fixtures')]
  public function an_empty_array_does_not_contain_fixture_values($value) {
    Assert::that([])->contains($value);
  }

  #[@test, @values('fixtures')]
  public function an_empty_array_does_not_contain_fixture_values_via_doesNotContain($value) {
    Assert::that([])->doesNotContain($value);
  }

  #[@test, @expect('unittest.AssertionFailedError'), @values('fixtures')]
  public function an_array_of_the_fixture_value_contains_the_value_via_doesNotContain($value) {
    Assert::that([$value])->doesNotContain($value);
  }
}