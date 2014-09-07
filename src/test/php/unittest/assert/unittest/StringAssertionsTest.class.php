<?php namespace unittest\assert\unittest;

use unittest\assert\Value;
use lang\types\String;

class StringAssertionsTest extends AbstractAssertionsTest {

  #[@test, @values([
  #  [0, ''], [4, 'test'],
  #  [0, new String('')], [4, new String('test')]
  #])]
  public function hasSize($size, $value) {
    $this->assertVerified(Value::of($value)->hasSize($size));
  }

  #[@test, @values([
  #  'Test', 'Testing', 'Test 1',
  #  new String('Test'), new String('Testing'), new String('Test 1')
  #])]
  public function strings_with_Test_start_with_Test($value) {
    $this->assertVerified(Value::of($value)->startsWith('Test'));
  }

  #[@test, @values([
  #  '', 'test',
  #  new String(''), new String('test')
  #])]
  public function other_values_dont_start_with_Test($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* starts with "Test"/'],
      Value::of($value)->startsWith('Test')
    );
  }

  #[@test, @values([
  #  'Test', 'A Test', 'UnitTest',
  #  new String('Test'), new String('A Test'), new String('UnitTest')
  #])]
  public function strings_with_Test_end_with_Test($value) {
    $this->assertVerified(Value::of($value)->endsWith('Test'));
  }

  #[@test, @values([
  #  '', 'test',
  #  new String(''), new String('test')
  #])]
  public function other_values_dont_end_with_Test($value) {
    $this->assertUnverified(
      ['/Failed to verify that .* ends with "Test"/'],
      Value::of($value)->endsWith('Test')
    );
  }

  #[@test, @values([
  #  'Test', 'Testing', 'Test 1',
  #  'A Test', 'UnitTest',
  #  'The Test of everything',
  #  new String('Test'), new String('Testing'), new String('Test 1'),
  #  new String('A Test'), new String('UnitTest'),
  #  new String('The Test of everything')
  #])]
  public function strings_with_Test_contain_Test($value) {
    $this->assertVerified(Value::of($value)->contains('Test'));
  }

  #[@test, @values([
  #  '', 'test',
  #  new String(''), new String('test')
  #])]
  public function other_values_dont_contain_Test($value) {
    $this->assertVerified(Value::of($value)->doesNotContain('Test'));
  }
}