<?php namespace unittest\assert;

use lang\IllegalStateException;
use util\collections\Vector;
use unittest\TestCase;
use unittest\TestAction;
use unittest\AssertionFailedError;

/**
 * Use this assertions action to decorate any class you wish to use the
 * `Assert::that()` method in.
 */
class Assertions extends \lang\Object implements TestAction {
  const DECLARATION = '#[@action(new \unittest\assert\Assertions())]';
  const CURRENT = 0;
  protected static $verify= [];

  /**
   * Creates a new verification
   *
   * @param  var $value
   * @return unittest.assert.Value
   * @throws lang.IllegalStateException
   */
  public static function verifyThat($value) {
    if (self::$verify) {
      if (is_array($value)) {
        return new ArrayPrimitiveValue($value, self::$verify[self::CURRENT]);
      } else if (is_string($value)) {
        return new StringPrimitiveValue($value, self::$verify[self::CURRENT]);
      } else if ($value instanceof \lang\types\ArrayList) {
        return new ArrayValue($value, self::$verify[self::CURRENT]);
      } else if ($value instanceof \lang\types\String) {
        return new StringValue($value, self::$verify[self::CURRENT]);
      } else {
        return new Value($value, self::$verify[self::CURRENT]);
      }
    } else {
      throw new IllegalStateException('You need to decorate your unittest class with '.self::DECLARATION);
    }
  }

  /**
   * Runs before a given test
   *
   * @param  unittest.TestCase $t
   * @throws unittest.AssertionFailedError
   */
  public function beforeTest(TestCase $t) {
    array_unshift(self::$verify, new Vector());
  }

  /**
   * Runs after a given test
   *
   * @param  unittest.TestCase $t
   * @throws unittest.AssertionFailedError
   */
  public function afterTest(TestCase $t) {
    $failed= new AssertionsFailed();
    foreach (array_shift(self::$verify) as $verify) {
      if (!$verify()) {
        $failed->add(new AssertionFailedError('Verification failed'));
      }
    }
    $failed->raiseIf();
  }
}