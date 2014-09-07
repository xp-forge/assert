<?php namespace unittest\assert\unittest;

use unittest\assert\Value;
use lang\Object;
use lang\XPClass;

class ObjectAssertionsTest extends TypeAssertionsTest {

  /** @return var[][] */
  protected function typeFixtures() {
    return [[null], [new Object()]];
  }

  #[@test, @values([['unittest.TestCase', 'lang.Object']])]
  public function verify_is_instance_of($parent) {
    $this->assertVerified(Value::of($this)->isInstanceOf($parent));
  }

  #[@test, @values('fixtures')]
  public function is_not_instance_of($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is an instance of lang.XPClass<lang.Runnable>/ms'],
      Value::of($value)->isInstanceOf('lang.Runnable')
    );
  }

  #[@test, @values([['unittest.TestCase', 'lang.Object']])]
  public function verify_is_instance_of_class($parent) {
    $this->assertVerified(Value::of($this)->isInstanceOf(XPClass::forName($parent)));
  }

  #[@test, @values('fixtures')]
  public function is_not_instance_of_class($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* is an instance of lang.XPClass<lang.Runnable>/ms'],
      Value::of($value)->isInstanceOf(XPClass::forName('lang.Runnable'))
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