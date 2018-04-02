<?php namespace unittest\assert\unittest;

use unittest\assert\Assertions;
use unittest\TestCase;
use lang\Value;
use lang\XPClass;

class ObjectAssertionsTest extends TypeAssertionsTest implements Value {

  /** @return var[][] */
  protected function typeFixtures() {
    return [[null], [new Name('Test')]];
  }

  #[@test, @values([TypeAssertionsTest::class, TestCase::class, Value::class])]
  public function verify_is_instance_of($parent) {
    $this->assertVerified(Assertions::of($this)->isInstanceOf($parent));
  }

  #[@test, @values('fixtures')]
  public function is_not_instance_of($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is an instance of lang.XPClass<lang.Runnable>/ms'],
      Assertions::of($value)->isInstanceOf('lang.Runnable')
    );
  }

  #[@test, @values([TypeAssertionsTest::class, TestCase::class, Value::class])]
  public function verify_is_instance_of_class($parent) {
    $this->assertVerified(Assertions::of($this)->isInstanceOf(XPClass::forName($parent)));
  }

  #[@test, @values('fixtures')]
  public function is_not_instance_of_class($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is an instance of lang.XPClass<lang.Runnable>/ms'],
      Assertions::of($value)->isInstanceOf(XPClass::forName('lang.Runnable'))
    );
  }

  #[@test, @values('typeFixtures')]
  public function objects_do_not_start_with_aynthing($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* starts with anything/ms'],
      Assertions::of($value)->startsWith('...')
    );
  }

  #[@test, @values('typeFixtures')]
  public function objects_do_not_end_with_aynthing($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* ends with anything/ms'],
      Assertions::of($value)->endsWith('...')
    );
  }

  #[@test, @values('typeFixtures')]
  public function objects_do_not_contain_aynthing($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* contains anything/ms'],
      Assertions::of($value)->contains('...')
    );
  }

  #[@test, @values('typeFixtures')]
  public function objects_does_not_not_contain_aynthing($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* does not contain anything/ms'],
      Assertions::of($value)->doesNotContain('...')
    );
  }
}