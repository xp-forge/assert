<?php namespace unittest\assert\unittest;

use unittest\assert\Value;
use lang\Object;
use lang\types\ArrayList;

class ArrayAssertionsTest extends TypeAssertionsTest {

  /** @return var[][] */
  protected function typeFixtures() {
    return [
      [[]],
      [new ArrayList()]
    ];
  }

  #[@test, @values([[[]], [[1]], [[1, 2]]])]
  public function array_has_size($value) {
    $this->assertVerified(Value::of($value)->hasSize(sizeof($value)));
  }

  #[@test, @values([[[1]], [[1, 2]]])]
  public function non_empty_array_does_not_have_a_size_of_0($value) {
    $this->assertUnverified(
      ['/Failed to verify that \[.*\] has a size of 0/ms'],
      Value::of([])->hasSize(0)
    );
  }

  #[@test, @values([[[]], [[1]], [[1, 2]]])]
  public function arrayList_has_size($value) {
    $this->assertVerified(Value::of(ArrayList::newInstance($value))->hasSize(sizeof($value)));
  }

  #[@test, @values([[[1]], [[1, 2]]])]
  public function non_empty_arrayList_does_not_have_a_size_of_0($value) {
    $this->assertUnverified(
      ['/Failed to verify that lang.types.ArrayList.+ has a size of 0/ms'],
      Value::of(new ArrayList())->hasSize(0)
    );
  }

  #[@test, @values('fixtures')]
  public function an_array_of_the_fixture_value_contains_the_value($value) {
    $this->assertVerified(Value::of([$value])->contains($value));
  }

  #[@test, @values('fixtures')]
  public function an_arrayList_of_the_fixture_value_contains_the_value($value) {
    $this->assertVerified(Value::of(new ArrayList($value))->contains($value));
  }

  #[@test, @values('fixtures')]
  public function an_array_of_the_fixture_value_and_an_object_contains_the_value($value) {
    $this->assertVerified(Value::of([new Object(), $value])->contains($value));
  }

  #[@test, @values('fixtures')]
  public function an_arrayList_of_the_fixture_value_and_an_object_contains_the_value($value) {
    $this->assertVerified(Value::of(new ArrayList(new Object(), $value))->contains($value));
  }

  #[@test, @values('fixtures')]
  public function an_empty_array_does_not_contain_fixture_values($value) {
    $this->assertUnverified(
      ['/Failed to verify that \[.*\] contains .*/ms'],
      Value::of([])->contains($value)
    );
  }

  #[@test, @values('fixtures')]
  public function an_empty_arrayList_does_not_contain_fixture_values($value) {
    $this->assertUnverified(
      ['/Failed to verify that lang.types.ArrayList.+ contains .*/ms'],
      Value::of(new ArrayList())->contains($value)
    );
  }

  #[@test, @values('fixtures')]
  public function an_empty_array_does_not_contain_fixture_values_via_doesNotContain($value) {
    $this->assertVerified(Value::of([])->doesNotContain($value));
  }

  #[@test, @values('fixtures')]
  public function an_empty_arrayList_does_not_contain_fixture_values_via_doesNotContain($value) {
    $this->assertVerified(Value::of(new ArrayList())->doesNotContain($value));
  }

  #[@test, @values('fixtures')]
  public function an_array_of_the_fixture_value_contains_the_value_via_doesNotContain($value) {
    $this->assertUnverified(
      ['/Failed to verify that \[.*\] does not contain .*/ms'],
      Value::of([])->doesNotContain($value)
    );
  }

  #[@test, @values('fixtures')]
  public function an_arrayList_of_the_fixture_value_contains_the_value_via_doesNotContain($value) {
    $this->assertUnverified(
      ['/Failed to verify that lang.types.ArrayList.+ does not contain .*/ms'],
      Value::of(new ArrayList($value))->doesNotContain($value)
    );
  }
}