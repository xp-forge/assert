<?php namespace unittest\assert;

/**
 * Base class for custom assertions. Overwrite this class as follows:
 *
 * ```php
 * namespace example;
 * use unittest\assert\Value;
 *
 * class TestCaseAssertion extends \unittest\assert\Assertion {
 *
 *   public static function hasName(Value $self, $name) {
 *     return $self->isInstanceOf('unittest.TestCase')->extracting('name')->isEqualTo($name);
 *   }
 * }
 * ```
 *
 * Inside your test class, import it:
 *
 * ```
 * new import('example.TestCaseAssertion');
 * ```
 *
 * You will then be able to write `Assert::that(...)->hasName('name')` in your test.
 *
 * @test  xp://unittest.assert.unittest.CustomAssertionsTest
 */
abstract class Assertion extends \lang\Object {

  static function __import($scope) {
    \xp::extensions(get_called_class(), $scope);
  }
}