<?php namespace unittest\assert\unittest;

use unittest\assert\Assertions;

class StringAssertionsTest extends TypeAssertionsTest {

  /** @return var[][] */
  protected function typeFixtures() {
    return [['Fixture']];
  }

  /** @return var[][] */
  protected function stringsStartingWithTest() {
    return [['Test'], ['Testing'], ['Test 1']];
  }

  /** @return var[][] */
  protected function stringsEndingWithTest() {
    return [['Test'], ['A Test'], ['UnitTest']];
  }

  /** @return var[][] */
  protected function stringsNotContainingTest() {
    return [[''], ['test']];
  }

  /** @return var[][] */
  protected function stringsContainingTest() {
    return array_merge($this->stringsStartingWithTest(), $this->stringsEndingWithTest(), [
      ['The Test of everything'],
    ]);
  }

  #[@test]
  public function verify_is_empty() {
    $this->assertVerified(Assertions::of('')->isEmpty());
  }

  #[@test, @values('stringsContainingTest')]
  public function is_empty($value) {
    $this->assertUnverified(
      ['/Failed to verify that .+ is empty/'],
      Assertions::of($value)->isEmpty()
    );
  }

  #[@test, @values([[0, ''], [4, 'test']])]
  public function hasSize($size, $value) {
    $this->assertVerified(Assertions::of($value)->hasSize($size));
  }

  #[@test, @values('stringsContainingTest')]
  public function strings_with_Test_are_not_empty($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* has a length of 0/'],
      Assertions::of($value)->hasSize(0)
    );
  }

  #[@test, @values('stringsStartingWithTest')]
  public function strings_with_Test_start_with_Test($value) {
    $this->assertVerified(Assertions::of($value)->startsWith('Test'));
  }

  #[@test, @values('stringsNotContainingTest')]
  public function other_values_dont_start_with_Test($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* starts with "Test"/'],
      Assertions::of($value)->startsWith('Test')
    );
  }

  #[@test, @values('stringsEndingWithTest')]
  public function strings_with_Test_end_with_Test($value) {
    $this->assertVerified(Assertions::of($value)->endsWith('Test'));
  }

  #[@test, @values('stringsNotContainingTest')]
  public function other_values_dont_end_with_Test($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* ends with "Test"/'],
      Assertions::of($value)->endsWith('Test')
    );
  }

  #[@test, @values('stringsContainingTest')]
  public function verify_strings_with_Test_contain_Test($value) {
    $this->assertVerified(Assertions::of($value)->contains('Test'));
  }

  #[@test, @values('stringsNotContainingTest')]
  public function strings_with_Test_contain_Test($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* contains "Test"/'],
      Assertions::of($value)->contains('Test')
    );
  }

  #[@test, @values('stringsNotContainingTest')]
  public function verify_other_values_dont_contain_Test($value) {
    $this->assertVerified(Assertions::of($value)->doesNotContain('Test'));
  }

  #[@test, @values('stringsContainingTest')]
  public function strings_with_Test_do_not_contain_Test($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* does not contain "Test"/'],
      Assertions::of($value)->doesNotContain('Test')
    );
  }
}