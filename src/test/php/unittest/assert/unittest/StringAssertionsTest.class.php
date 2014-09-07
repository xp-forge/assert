<?php namespace unittest\assert\unittest;

use unittest\assert\Value;
use lang\types\String;

class StringAssertionsTest extends AbstractAssertionsTest {

  /** @return var[][] */
  protected function stringsStartingWithTest() {
    return [
      ['Test'], ['Testing'], ['Test 1'],
      [new String('Test')], [new String('Testing')], [new String('Test 1')]
    ];
  }

  /** @return var[][] */
  protected function stringsEndingWithTest() {
    return [
      ['Test'], ['A Test'], ['UnitTest'],
      [new String('Test')], [new String('A Test')], [new String('UnitTest')]
    ];
  }

  /** @return var[][] */
  protected function stringsNotContainingTest() {
    return [
      [''], ['test'],
      [new String('')], [new String('test')]
    ];
  }

  /** @return var[][] */
  protected function stringsContainingTest() {
    return array_merge($this->stringsStartingWithTest(), $this->stringsEndingWithTest(), [
      ['The Test of everything'],
      [new String('The Test of everything')]
    ]);
  }

  #[@test, @values([
  #  [0, ''], [4, 'test'],
  #  [0, new String('')], [4, new String('test')]
  #])]
  public function hasSize($size, $value) {
    $this->assertVerified(Value::of($value)->hasSize($size));
  }

  #[@test, @values('stringsContainingTest')]
  public function strings_with_Test_are_not_empty($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* has a length of 0/'],
      Value::of($value)->hasSize(0)
    );
  }

  #[@test, @values('stringsStartingWithTest')]
  public function strings_with_Test_start_with_Test($value) {
    $this->assertVerified(Value::of($value)->startsWith('Test'));
  }

  #[@test, @values('stringsNotContainingTest')]
  public function other_values_dont_start_with_Test($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* starts with "Test"/'],
      Value::of($value)->startsWith('Test')
    );
  }

  #[@test, @values('stringsEndingWithTest')]
  public function strings_with_Test_end_with_Test($value) {
    $this->assertVerified(Value::of($value)->endsWith('Test'));
  }

  #[@test, @values('stringsNotContainingTest')]
  public function other_values_dont_end_with_Test($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* ends with "Test"/'],
      Value::of($value)->endsWith('Test')
    );
  }

  #[@test, @values('stringsContainingTest')]
  public function verify_strings_with_Test_contain_Test($value) {
    $this->assertVerified(Value::of($value)->contains('Test'));
  }

  #[@test, @values('stringsNotContainingTest')]
  public function strings_with_Test_contain_Test($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* contains "Test"/'],
      Value::of($value)->doesNotContain('Test')
    );
  }

  #[@test, @values('stringsNotContainingTest')]
  public function verify_other_values_dont_contain_Test($value) {
    $this->assertVerified(Value::of($value)->doesNotContain('Test'));
  }

  #[@test, @values('stringsContainingTest')]
  public function strings_with_Test_do_not_contain_Test($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* does not contain "Test"/'],
      Value::of($value)->doesNotContain('Test')
    );
  }
}