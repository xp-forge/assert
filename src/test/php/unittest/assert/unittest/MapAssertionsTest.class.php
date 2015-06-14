<?php namespace unittest\assert\unittest;

use unittest\assert\Value;
use lang\Object;

class MapAssertionsTest extends TypeAssertionsTest {

  /** @return var[][] */
  protected function typeFixtures() {
    return [[[]]];
  }

  /** @return var[][] */
  protected function mapsNotContainingTest() {
    return [
      [[]],
      [['color' => 'green']],
      [['color' => 'green', 'price' => 12.99]]
    ];
  }

  /** @return var[][] */
  protected function mapsContainingTest() {
    return [
      [['color' => 'test']],
      [['color' => 'test', 'price' => 12.99]]
    ];
  }

  /** @return var[][] */
  protected function allMaps() {
    return array_merge($this->mapsNotContainingTest(), $this->mapsContainingTest());
  }

  #[@test, @values('allMaps')]
  public function verify_has_size($value) {
    $this->assertVerified(Value::of($value)->hasSize(sizeof($value)));
  }

  #[@test, @values('allMaps')]
  public function has_size($value) {
    $this->assertUnverified(
      ['/Failed to verify that .+ has a size of 7/ms'],
      Value::of($value)->hasSize(7)
    );
  }

  #[@test, @values('mapsContainingTest')]
  public function verify_contains_test($value) {
    $this->assertVerified(Value::of($value)->contains('test'));
  }

  #[@test, @values('mapsNotContainingTest')]
  public function contains_test($value) {
    $this->assertUnverified(
      ['/Failed to verify that .+ contains "test"/ms'],
      Value::of($value)->contains('test')
    );
  }

  #[@test, @values('mapsNotContainingTest')]
  public function verify_does_not_contains_test($value) {
    $this->assertVerified(Value::of($value)->doesNotContain('test'));
  }

  #[@test, @values('mapsContainingTest')]
  public function does_not_contains_test($value) {
    $this->assertUnverified(
      ['/Failed to verify that .+ does not contain "test"/ms'],
      Value::of($value)->doesNotContain('test')
    );
  }

  #[@test, @values('allMaps')]
  public function objects_do_not_start_with_aynthing($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* starts with anything/ms'],
      Value::of($value)->startsWith('...')
    );
  }

  #[@test, @values('allMaps')]
  public function objects_do_not_end_with_aynthing($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* ends with anything/ms'],
      Value::of($value)->endsWith('...')
    );
  }
}