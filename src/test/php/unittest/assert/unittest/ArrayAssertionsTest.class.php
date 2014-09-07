<?php namespace unittest\assert\unittest;

use unittest\assert\Value;
use lang\Object;
use lang\types\ArrayList;

class ArrayAssertionsTest extends AbstractAssertionsTest {

  #[@test, @values([[[]], [[1]], [[1, 2]]])]
  public function array_has_size($value) {
    $this->assertVerified(Value::of($value)->hasSize(sizeof($value)));
  }

  #[@test, @values([[[]], [[1]], [[1, 2]]])]
  public function arrayList_has_size($value) {
    $this->assertVerified(Value::of(ArrayList::newInstance($value))->hasSize(sizeof($value)));
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
    $this->assertUnVerified(
      ['/Failed to verify that \[.*\] contains .*/ms'],
      Value::of([])->contains($value)
    );
  }

  #[@test, @values('fixtures')]
  public function an_empty_arrayList_does_not_contain_fixture_values($value) {
    $this->assertUnVerified(
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
    $this->assertUnVerified(
      ['/Failed to verify that \[.*\] does not contain .*/ms'],
      Value::of([])->doesNotContain($value)
    );
  }

  #[@test, @values('fixtures')]
  public function an_arrayList_of_the_fixture_value_contains_the_value_via_doesNotContain($value) {
    $this->assertUnVerified(
      ['/Failed to verify that lang.types.ArrayList.+ does not contain .*/ms'],
      Value::of(new ArrayList($value))->doesNotContain($value)
    );
  }}