<?php namespace unittest\assert\unittest;

use unittest\assert\Value;
use lang\Object;
use lang\types\ArrayMap;

class MapAssertionsTest extends TypeAssertionsTest {

  /** @return var[][] */
  protected function typeFixtures() {
    return [
      [new ArrayMap([])]
    ];
  }

  /** @return var[][] */
  protected function mapsNotContainingTest() {
    return [
      [new ArrayMap([])],
      [new ArrayMap(['color' => 'green'])],
      [new ArrayMap(['color' => 'green', 'price' => 12.99])]
    ];
  }

  /** @return var[][] */
  protected function mapsContainingTest() {
    return [
      [new ArrayMap(['color' => 'test'])],
      [new ArrayMap(['color' => 'test', 'price' => 12.99])]
    ];
  }

  /** @return var[][] */
  protected function allMaps() {
    return array_merge($this->mapsNotContainingTest(), $this->mapsContainingTest());
  }

  #[@test, @values('allMaps')]
  public function verify_has_size($value) {
    $this->assertVerified(Value::of($value)->hasSize($value->size));
  }

  #[@test, @values('allMaps')]
  public function has_size($value) {
    $this->assertUnverified(
      ['/Failed to verify that lang.types.ArrayMap.+ has a size of 7/'],
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
      ['/Failed to verify that lang.types.ArrayMap.+ contains "test"/'],
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
      ['/Failed to verify that lang.types.ArrayMap.+ does not contain "test"/'],
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