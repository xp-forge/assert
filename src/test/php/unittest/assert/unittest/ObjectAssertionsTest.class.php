<?php namespace unittest\assert\unittest;

use unittest\assert\Value;
use lang\Object;

class ObjectAssertionsTest extends TypeAssertionsTest {

  /** @return var[][] */
  protected function typeFixtures() {
    return [[null], [new Object()]];
  }

  #[@test, @values('typeFixtures')]
  public function objects_do_not_have_a_size($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* has a size/ms'],
      Value::of($value)->hasSize(0)
    );
  }

  #[@test, @values('typeFixtures')]
  public function objects_do_not_start_with_aynthing($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* starts with anything/ms'],
      Value::of($value)->startsWith('...')
    );
  }

  #[@test, @values('typeFixtures')]
  public function objects_do_not_end_with_aynthing($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* ends with anything/ms'],
      Value::of($value)->endsWith('...')
    );
  }

  #[@test, @values('typeFixtures')]
  public function objects_do_not_contain_aynthing($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* contains anything/ms'],
      Value::of($value)->contains('...')
    );
  }

  #[@test, @values('typeFixtures')]
  public function objects_does_not_not_contain_aynthing($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* does not contain anything/ms'],
      Value::of($value)->doesNotContain('...')
    );
  }
}