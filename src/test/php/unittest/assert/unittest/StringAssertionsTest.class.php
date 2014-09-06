<?php namespace unittest\assert\unittest;

use unittest\assert\Assert;
use unittest\assert\Assertions;
use lang\Object;
use lang\types\String;

#[@action(new Assertions())]
class StringAssertionsTest extends AbstractAssertionsTest {

  #[@test, @values([
  #  'Test', 'Testing', 'Test 1',
  #  new String('Test'), new String('Testing'), new String('Test 1')
  #])]
  public function strings_with_Test_start_with_Test($value) {
    Assert::that($value)->startsWith('Test');
  }

  #[@test, @expect('unittest.AssertionFailedError'), @values([
  #  '', 'test',
  #  new String(''), new String('test')
  #])]
  public function other_values_dont_start_with_Test($value) {
    Assert::that($value)->startsWith('Test');
  }

  #[@test, @values([
  #  'Test', 'A Test', 'UnitTest',
  #  new String('Test'), new String('A Test'), new String('UnitTest')
  #])]
  public function strings_with_Test_end_with_Test($value) {
    Assert::that($value)->endsWith('Test');
  }

  #[@test, @expect('unittest.AssertionFailedError'), @values([
  #  '', 'test',
  #  new String(''), new String('test')
  #])]
  public function other_values_dont_end_with_Test($value) {
    Assert::that($value)->endsWith('Test');
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
    Assert::that($value)->contains('Test');
  }

  #[@test, @expect('unittest.AssertionFailedError'), @values([
  #  'Test', 'Testing', 'Test 1',
  #  'A Test', 'UnitTest',
  #  'The Test of everything',
  #  new String('Test'), new String('Testing'), new String('Test 1'),
  #  new String('A Test'), new String('UnitTest'),
  #  new String('The Test of everything')
  #])]
  public function strings_with_Test_contain_Test_via_doesNotContain($value) {
    Assert::that($value)->doesNotContain('Test');
  }
}