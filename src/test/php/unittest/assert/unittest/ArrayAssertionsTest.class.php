<?php namespace unittest\assert\unittest;

use unittest\assert\Assertions;

class ArrayAssertionsTest extends TypeAssertionsTest {

  /** @return var[][] */
  protected function typeFixtures() { return [[['Fixture']]]; }

  #[@test]
  public function verify_is_empty() {
    $this->assertVerified(Assertions::of([])->isEmpty());
  }

  #[@test, @values([[[1]], [[1, 2]]])]
  public function is_empty($value) {
    $this->assertUnverified(
      ['/Failed to verify that .+ is empty/ms'],
      Assertions::of($value)->isEmpty()
    );
  }

  #[@test, @values([[[]], [[1]], [[1, 2]]])]
  public function array_has_size($value) {
    $this->assertVerified(Assertions::of($value)->hasSize(sizeof($value)));
  }

  #[@test, @values([[[1]], [[1, 2]]])]
  public function non_empty_array_does_not_have_a_size_of_0($value) {
    $this->assertUnverified(
      ['/Failed to verify that \[.*\] has a size of 0/ms'],
      Assertions::of($value)->hasSize(0)
    );
  }

  #[@test, @values('fixtures')]
  public function an_array_of_the_fixture_value_contains_the_value($value) {
    $this->assertVerified(Assertions::of([$value])->contains($value));
  }

  #[@test, @values('fixtures')]
  public function an_array_of_the_fixture_value_and_an_object_contains_the_value($value) {
    $this->assertVerified(Assertions::of([new Name('Test'), $value])->contains($value));
  }

  #[@test, @values('fixtures')]
  public function an_empty_array_does_not_contain_fixture_values($value) {
    $this->assertUnverified(
      ['/Failed to verify that \[.*\] contains .*/ms'],
      Assertions::of([])->contains($value)
    );
  }

  #[@test, @values('fixtures')]
  public function an_empty_array_does_not_contain_fixture_values_via_doesNotContain($value) {
    $this->assertVerified(Assertions::of([])->doesNotContain($value));
  }

  #[@test, @values('fixtures')]
  public function an_array_of_the_fixture_value_contains_the_value_via_doesNotContain($value) {
    $this->assertUnverified(
      ['/Failed to verify that \[.*\] does not contain .*/ms'],
      Assertions::of([$value])->doesNotContain($value)
    );
  }

  #[@test, @values([[[1, 2, 3]], [[1]]])]
  public function verify_array_starting_with_1($value) {
    $this->assertVerified(Assertions::of($value)->startsWith(1));
  }

  #[@test, @values([[[3, 2, 1]], [[1]]])]
  public function verify_array_ending_with_1($value) {
    $this->assertVerified(Assertions::of($value)->endsWith(1));
  }
}